@props(['height' => 300, 'strands' => 70, 'wind' => 10, 'speed' => 0.45, 'overlay' => 0.92])
@php($uid = 'hairWind_' . \Illuminate\Support\Str::random(6))

<div class="relative w-full">

    {{-- Barra dourada superior --}}
    <div class="w-full h-px" style="background: linear-gradient(90deg, transparent, #c9a24b 10%, #c9a24b 90%, transparent);"></div>

    <div class="relative w-full overflow-hidden" style="min-height: {{ $height }}px;">
        <svg id="{{ $uid }}" viewBox="0 0 1200 {{ $height }}" preserveAspectRatio="none" class="absolute inset-0 w-full h-full pointer-events-none">
            <g class="text-goldenrod" stroke="currentColor" fill="none" stroke-linecap="round"></g>
            <g class="text-champagne" stroke="currentColor" fill="none" stroke-linecap="round"></g>
        </svg>

        <div class="absolute inset-0 pointer-events-none" style="background: rgba(17,17,17,{{ $overlay }}); z-index: 1;"></div>

        <div class="relative z-10 flex items-center justify-center px-6 lg:px-16 py-10 lg:py-0" style="min-height: {{ $height }}px;">
            <div class="w-full max-w-5xl flex flex-col lg:flex-row items-center gap-6 lg:gap-8">

                {{-- Foto da dona --}}
                <div class="flex-shrink-0">
                    <img
                        src="{{ asset('assets/img/dona-salao-selfie.png') }}"
                        alt="Dona do salão"
                        class="w-28 h-28 sm:w-36 sm:h-36 lg:w-48 lg:h-48 rounded-full object-cover object-top border-4 border-goldenrod shadow-[0_0_30px_rgba(201,162,75,0.4)]"
                    >
                </div>

                {{-- Texto --}}
                <div class="text-center lg:text-left">
                    <h3 class="text-xl sm:text-2xl lg:text-3xl font-bold text-goldenrod font-cinzel mb-2 lg:mb-3">
                        Maria Angélica
                    </h3>
                    <p class="text-champagne text-sm sm:text-base lg:text-lg leading-relaxed max-w-xl">
                        Aqui entra o texto que quiser sobre a trajetória, experiência,
                        paixão pelo que faz, ou qualquer mensagem que queira transmitir aos clientes.
                    </p>
                </div>

            </div>
        </div>
    </div>

    {{-- Barra dourada inferior --}}
    <div class="w-full h-px" style="background: linear-gradient(90deg, transparent, #c9a24b 10%, #c9a24b 90%, transparent);"></div>

</div>

<script>
(function () {
    function initHairWind() {
        const svg = document.getElementById('{{ $uid }}');
        if (!svg || svg.dataset.inited) return;
        svg.dataset.inited = '1';

        const groups = svg.querySelectorAll('g');
        const H = {{ $height }};
        const W = 1200;
        const NUM = {{ $strands }};
        const SEGMENTS = 18;
        const strands = [];

        const rand = (min, max) => min + Math.random() * (max - min);

        for (let i = 0; i < NUM; i++) {
            const rootX = rand(W * 0.32, W * 0.62);
            const rootY = rand(-20, 10);
            const length = rand(H * 0.9, H * 1.6);
            const drift = rand(W * 0.15, W * 0.55);
            const wiggleAmt = rand(15, 45);
            const wiggleFreq = rand(1.2, 2.4);
            const wigglePhase = rand(0, Math.PI * 2);
            const thickness = rand(0.8, 2.0);
            const phase = rand(0, Math.PI * 2);
            const windFreq = rand(0.8, 1.3);
            const flexibility = rand(0.6, 1.3);
            const opacity = rand(0.4, 0.9);

            const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
            path.setAttribute('stroke-width', thickness);
            path.setAttribute('opacity', opacity);
            groups[i % 2].appendChild(path);

            strands.push({ rootX, rootY, length, drift, wiggleAmt, wiggleFreq, wigglePhase, phase, windFreq, flexibility, path });
        }

        function smoothPath(points) {
            if (points.length < 3) return '';
            let d = `M ${points[0].x.toFixed(2)} ${points[0].y.toFixed(2)} `;
            for (let i = 0; i < points.length - 1; i++) {
                const p0 = points[i === 0 ? i : i - 1];
                const p1 = points[i];
                const p2 = points[i + 1];
                const p3 = points[i + 2] || p2;
                const cp1x = p1.x + (p2.x - p0.x) / 6;
                const cp1y = p1.y + (p2.y - p0.y) / 6;
                const cp2x = p2.x - (p3.x - p1.x) / 6;
                const cp2y = p2.y - (p3.y - p1.y) / 6;
                d += `C ${cp1x.toFixed(2)} ${cp1y.toFixed(2)}, ${cp2x.toFixed(2)} ${cp2y.toFixed(2)}, ${p2.x.toFixed(2)} ${p2.y.toFixed(2)} `;
            }
            return d;
        }

        const windStrength = {{ $wind }};
        const speed = {{ $speed }};

        function frame(timeMs) {
            if (!document.body.contains(svg)) return;
            const time = timeMs / 1000;
            for (const s of strands) {
                const points = [];
                for (let j = 0; j <= SEGMENTS; j++) {
                    const u = j / SEGMENTS;
                    const restX = s.rootX + s.drift * u + Math.sin(u * Math.PI * s.wiggleFreq + s.wigglePhase) * s.wiggleAmt * u;
                    const restY = s.rootY + u * s.length;
                    const wave = Math.sin(u * Math.PI * s.windFreq * 2 - time * speed * 3 + s.phase);
                    const amp = windStrength * 14 * Math.pow(u, 1.3) * s.flexibility;
                    const dx = amp * wave + windStrength * 10 * u;
                    const dy = amp * 0.2 * Math.cos(u * Math.PI * s.windFreq * 2 - time * speed * 3 + s.phase);
                    points.push({ x: restX + dx, y: restY + dy });
                }
                s.path.setAttribute('d', smoothPath(points));
            }
            requestAnimationFrame(frame);
        }
        requestAnimationFrame(frame);
    }

    document.addEventListener('DOMContentLoaded', initHairWind);
    document.addEventListener('livewire:navigated', initHairWind);
    if (document.readyState !== 'loading') initHairWind();
})();
</script>
