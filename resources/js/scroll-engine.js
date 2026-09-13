export function initScrollCanvas(container) {
    if (!container) return;
    const canvas = container.querySelector('canvas');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    const totalFrames = parseInt(container.dataset.totalFrames || 185, 10), padLength = parseInt(container.dataset.padLength || 6, 10);
    const ext = (container.dataset.extension || 'jpg').replace(/^\./, ''), seqPath = container.dataset.sequencePath || container.dataset.baseUrl || '/assets/sequences/hero';
    const storeKey = container.dataset.storeKey || 'heroScroll';

    const isMobile = window.innerWidth < 768, stride = isMobile && totalFrames > 60 ? 3 : 1;
    const frameIndices = [];
    for (let i = 0; i < totalFrames; i += stride) frameIndices.push(i);
    if (frameIndices[frameIndices.length - 1] !== totalFrames - 1) frameIndices.push(totalFrames - 1);

    const images = new Map();
    let currentRenderedIndex = -1, targetIndex = 0, isTicking = false;

    function getFrameUrl(idx) {
        const p = String(idx).padStart(padLength, '0');
        if (seqPath.endsWith('_')) return `${seqPath}${p}.${ext}`;
        return `${seqPath.replace(/\/$/, '')}/frame_${p}.${ext}`;
    }

    function updateProgress(progress, ready) {
        const store = window.Alpine?.store(storeKey);
        if (store) { store.progress = progress; if (ready !== undefined) store.isReady = ready; }
        window.dispatchEvent(new CustomEvent('hero-scroll', { detail: { progress, ready, container } }));
    }

    function getClosestLoaded(target) {
        if (images.has(target) && images.get(target).complete) return target;
        let best = 0, minDiff = Infinity;
        for (const [idx, img] of images.entries()) {
            if (img.complete && img.naturalWidth > 0 && Math.abs(idx - target) < minDiff) {
                minDiff = Math.abs(idx - target); best = idx;
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
        if (canvas.width !== displayW || canvas.height !== displayH) { canvas.width = displayW; canvas.height = displayH; }

        const scale = Math.max(canvas.width / img.naturalWidth, canvas.height / img.naturalHeight);
        const drawW = Math.ceil(img.naturalWidth * scale), drawH = Math.ceil(img.naturalHeight * scale);
        const dx = Math.floor((canvas.width - drawW) / 2), dy = Math.floor((canvas.height - drawH) / 2);
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.drawImage(img, dx, dy, drawW, drawH);
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
                const dpr = Math.min(window.devicePixelRatio || 1, 2);
                if (targetIndex !== currentRenderedIndex || canvas.width !== Math.round(canvas.clientWidth * dpr) || canvas.height !== Math.round(canvas.clientHeight * dpr)) render(targetIndex);
                isTicking = false;
            });
        }
    }

    function preload(idx, onDone) {
        if (images.has(idx)) { if (onDone) onDone(); return; }
        const img = new Image();
        img.src = getFrameUrl(idx);
        img.onload = () => { images.set(idx, img); if (currentRenderedIndex === -1 && idx === frameIndices[0]) render(idx); if (onDone) onDone(); };
        img.onerror = () => { if (onDone) onDone(); };
    }

    const initialTier = isMobile ? frameIndices : frameIndices.filter((_, i) => i % (totalFrames < 50 ? 2 : 3) === 0);
    let loaded = 0;

    initialTier.forEach(idx => {
        preload(idx, () => {
            loaded++;
            if (window.Alpine?.store(storeKey)) window.Alpine.store(storeKey).loaded = Math.round((loaded / initialTier.length) * 100);
            if (loaded >= 1) updateProgress(0, true);
            if (loaded === initialTier.length && !isMobile) frameIndices.filter(i => !images.has(i)).forEach(i => preload(i));
        });
    });

    setTimeout(() => updateProgress(0, true), 1000);
    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', () => { if (currentRenderedIndex !== -1) render(currentRenderedIndex); }, { passive: true });
    onScroll();
}

export function initHeroScrollEngine(config = {}) {
    const el = document.getElementById(config.containerId || 'hero-scroll-container') || document.querySelector('[data-scroll-container]');
    if (el) initScrollCanvas(el);
}
