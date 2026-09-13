export function initHeroScrollEngine(config = {}) {
    const canvas = document.getElementById(config.canvasId || 'hero-scroll-canvas');
    const container = document.getElementById(config.containerId || 'hero-scroll-container');
    if (!canvas || !container) return;

    const ctx = canvas.getContext('2d'), totalFrames = 185;
    const isMobile = window.innerWidth < 768, stride = isMobile ? 3 : 1;
    const baseUrl = container.dataset.baseUrl || config.baseUrl || '/assets/sequences/hero';
    const frameIndices = [];
    for (let i = 0; i < totalFrames; i += stride) frameIndices.push(i);
    if (frameIndices[frameIndices.length - 1] !== totalFrames - 1) frameIndices.push(totalFrames - 1);

    const images = new Map();
    let currentRenderedIndex = -1, targetIndex = 0, isTicking = false;

    function getFrameUrl(idx) {
        return `${baseUrl}/frame_${String(idx).padStart(6, '0')}.jpg`;
    }

    function updateProgress(progress, ready) {
        if (window.Alpine?.store('heroScroll')) {
            const store = window.Alpine.store('heroScroll');
            store.progress = progress;
            if (ready !== undefined) store.isReady = ready;
        }
        window.dispatchEvent(new CustomEvent('hero-scroll', { detail: { progress, ready } }));
    }

    function getClosestLoaded(target) {
        if (images.has(target) && images.get(target).complete) return target;
        let best = 0, minDiff = Infinity;
        for (const [idx, img] of images.entries()) {
            if (img.complete && img.naturalWidth > 0 && Math.abs(idx - target) < minDiff) {
                minDiff = Math.abs(idx - target);
                best = idx;
            }
        }
        return best;
    }

    function render(index) {
        const frameToDraw = getClosestLoaded(index);
        const img = images.get(frameToDraw);
        if (!img?.complete || !img.naturalWidth) return;

        const dpr = Math.min(window.devicePixelRatio || 1, 2);
        const displayW = Math.round(canvas.clientWidth * dpr), displayH = Math.round(canvas.clientHeight * dpr);
        if (!displayW || !displayH) return;

        if (canvas.width !== displayW || canvas.height !== displayH) {
            canvas.width = displayW;
            canvas.height = displayH;
        }

        const scale = Math.max(displayW / img.naturalWidth, displayH / img.naturalHeight);
        const drawW = img.naturalWidth * scale, drawH = img.naturalHeight * scale;
        ctx.clearRect(0, 0, displayW, displayH);
        ctx.drawImage(img, (displayW - drawW) / 2, (displayH - drawH) / 2, drawW, drawH);
        currentRenderedIndex = frameToDraw;
    }

    function onScroll() {
        const rect = container.getBoundingClientRect();
        const maxScroll = container.offsetHeight - window.innerHeight;
        if (maxScroll <= 0) return;

        const t = Math.max(0, Math.min(1, -rect.top / maxScroll));
        const idx = Math.min(Math.floor(t * frameIndices.length), frameIndices.length - 1);
        targetIndex = frameIndices[idx];
        updateProgress(t);

        if (!isTicking) {
            isTicking = true;
            requestAnimationFrame(() => {
                if (targetIndex !== currentRenderedIndex) render(targetIndex);
                isTicking = false;
            });
        }
    }

    function preload(idx, onDone) {
        if (images.has(idx)) {
            if (onDone) onDone();
            return;
        }
        const img = new Image();
        img.src = getFrameUrl(idx);
        img.onload = () => {
            images.set(idx, img);
            if (currentRenderedIndex === -1 && idx === frameIndices[0]) render(idx);
            if (onDone) onDone();
        };
        img.onerror = () => { if (onDone) onDone(); };
    }

    const initialTier = isMobile ? frameIndices : frameIndices.filter((_, i) => i % 4 === 0);
    let loaded = 0;

    initialTier.forEach(idx => {
        preload(idx, () => {
            loaded++;
            const pct = Math.round((loaded / initialTier.length) * 100);
            if (window.Alpine?.store('heroScroll')) {
                window.Alpine.store('heroScroll').loaded = pct;
            }
            if (loaded >= 1) updateProgress(0, true);
            if (loaded === initialTier.length && !isMobile) {
                frameIndices.filter(i => !images.has(i)).forEach(i => preload(i));
            }
        });
    });

    setTimeout(() => updateProgress(0, true), 1200);

    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', () => { if (currentRenderedIndex !== -1) render(currentRenderedIndex); }, { passive: true });
    onScroll();
}
