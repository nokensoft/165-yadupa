{{-- Page Loading Overlay — White Glass Blur --}}
<div id="page-loading" class="fixed inset-0 z-[9999] flex items-center justify-center bg-white/70 backdrop-blur-md transition-opacity duration-500">
    <div class="loading-rings">
        <div class="ring ring-outer"></div>
        <div class="ring ring-inner"></div>
    </div>
</div>

<style>
    .loading-rings {
        position: relative;
        width: 90px;
        height: 90px;
    }
    .ring {
        position: absolute;
        border-radius: 50%;
        border: 3px solid transparent;
    }
    .ring-outer {
        inset: 0;
        border-top-color: #15803d;
        border-right-color: #15803d;
        animation: ringSpinOuter 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
        filter: drop-shadow(0 0 6px rgba(21, 128, 61, 0.6));
    }
    .ring-inner {
        inset: 14px;
        border-bottom-color: #22c55e;
        border-left-color: #22c55e;
        animation: ringSpinInner 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
        filter: drop-shadow(0 0 6px rgba(34, 197, 94, 0.6));
    }
    @keyframes ringSpinOuter {
        0%   { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    @keyframes ringSpinInner {
        0%   { transform: rotate(0deg); }
        100% { transform: rotate(-360deg); }
    }
</style>

<script>
    window.addEventListener('load', function () {
        var loader = document.getElementById('page-loading');
        if (loader) {
            loader.style.opacity = '0';
            setTimeout(function () {
                loader.style.display = 'none';
            }, 500);
        }
    });
</script>
