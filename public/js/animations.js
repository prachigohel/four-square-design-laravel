/* =============================================================
   Four Square Design — 3D Animation System
   Requires: GSAP 3 + ScrollTrigger, Three.js (CDN in layout)
   ============================================================= */

(function () {
    'use strict';

    const reduced  = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const isMobile = window.innerWidth < 768;

    /* Cache the very first <section> so we can reliably exclude
       hero elements from scroll-trigger animations.              */
    const heroSection = document.querySelector('section');

    function inHero(el) {
        return heroSection && heroSection.contains(el);
    }

    /* ===========================================================
       1. THREE.JS PARTICLE BACKGROUND
    =========================================================== */
    function initParticles() {
        if (typeof THREE === 'undefined') return;
        const canvas = document.getElementById('particle-canvas');
        if (!canvas) return;

        const scene    = new THREE.Scene();
        const camera   = new THREE.PerspectiveCamera(60, innerWidth / innerHeight, 0.1, 500);
        const renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: !isMobile });

        renderer.setSize(innerWidth, innerHeight);
        renderer.setPixelRatio(Math.min(devicePixelRatio, 2));
        camera.position.z = 10;

        /* — Ambient particles — */
        const COUNT = isMobile ? 60 : 170;
        const pos   = new Float32Array(COUNT * 3);
        for (let i = 0; i < COUNT; i++) {
            pos[i * 3]     = (Math.random() - .5) * 30;
            pos[i * 3 + 1] = (Math.random() - .5) * 30;
            pos[i * 3 + 2] = (Math.random() - .5) * 14;
        }
        const pGeo = new THREE.BufferGeometry().setAttribute('position', new THREE.BufferAttribute(pos, 3));
        const pMat = new THREE.PointsMaterial({ color: 0xf59e0b, size: 0.055, transparent: true, opacity: 0.42, sizeAttenuation: true });
        const pts  = new THREE.Points(pGeo, pMat);
        scene.add(pts);

        /* — Large wireframe icosahedron — */
        const icoEdges = new THREE.EdgesGeometry(new THREE.IcosahedronGeometry(4, 0));
        const icoMat   = new THREE.LineBasicMaterial({ color: 0xf59e0b, transparent: true, opacity: 0.055 });
        const ico      = new THREE.LineSegments(icoEdges, icoMat);
        scene.add(ico);

        /* — Floating octahedron (right) — */
        const oct = new THREE.LineSegments(
            new THREE.EdgesGeometry(new THREE.OctahedronGeometry(0.8, 0)),
            new THREE.LineBasicMaterial({ color: 0xfbbf24, transparent: true, opacity: 0.18 })
        );
        oct.position.set(6, 2.5, -2);
        scene.add(oct);

        /* — Floating tetrahedron (left) — */
        const tet = new THREE.LineSegments(
            new THREE.EdgesGeometry(new THREE.TetrahedronGeometry(0.6, 0)),
            new THREE.LineBasicMaterial({ color: 0xf59e0b, transparent: true, opacity: 0.14 })
        );
        tet.position.set(-7, -2.5, -3);
        scene.add(tet);

        let mx = 0, my = 0, tx = 0, ty = 0;
        document.addEventListener('mousemove', e => {
            mx = (e.clientX / innerWidth  - .5) * 2;
            my = (e.clientY / innerHeight - .5) * 2;
        });

        const clk = new THREE.Clock();
        (function tick() {
            requestAnimationFrame(tick);
            const t = clk.getElapsedTime();
            tx += (mx - tx) * .03;
            ty += (my - ty) * .03;

            pts.rotation.y = t * .03 + tx * .28;
            pts.rotation.x = t * .015 + ty * .2;
            ico.rotation.y = t * .055;
            ico.rotation.x = t * .035;
            ico.rotation.z = t * .02;
            oct.rotation.x = t * .45;
            oct.rotation.y = t * .3;
            tet.rotation.x = t * -.35;
            tet.rotation.z = t * .28;

            renderer.render(scene, camera);
        })();

        window.addEventListener('resize', () => {
            camera.aspect = innerWidth / innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(innerWidth, innerHeight);
        });
    }

    /* ===========================================================
       3. CUSTOM CURSOR (desktop only)
    =========================================================== */
    function initCursor() {
        const ring = document.getElementById('custom-cursor');
        const dot  = document.getElementById('cursor-dot');
        if (!ring || !dot || isMobile) return;

        let cx = -200, cy = -200, dx = -200, dy = -200;
        document.addEventListener('mousemove', e => { cx = e.clientX; cy = e.clientY; });
        document.addEventListener('mouseleave', () => gsap.to([ring, dot], { autoAlpha: 0, duration: .3 }));
        document.addEventListener('mouseenter', () => gsap.to([ring, dot], { autoAlpha: 1, duration: .3 }));

        (function loop() {
            dx += (cx - dx) * .13;
            dy += (cy - dy) * .13;
            ring.style.transform = `translate(${cx - 20}px, ${cy - 20}px)`;
            dot.style.transform  = `translate(${dx - 4}px, ${dy - 4}px)`;
            requestAnimationFrame(loop);
        })();

        document.querySelectorAll('a, button, .glass-card, .portfolio-card, input, textarea').forEach(el => {
            el.addEventListener('mouseenter', () => ring.classList.add('is-hover'));
            el.addEventListener('mouseleave', () => ring.classList.remove('is-hover'));
        });
    }

    /* ===========================================================
       4. HERO ENTRANCE — runs FIRST to lock initial states
          Uses gsap.set() + gsap.to() (never gsap.from) so there
          is no race with scroll triggers on the same elements.
    =========================================================== */
    function heroEntrance() {
        if (typeof gsap === 'undefined' || !heroSection) return;

        /* Collect hero elements */
        const q      = sel => heroSection.querySelector(sel);
        const h1s    = heroSection.querySelectorAll('h1');
        const tag    = q('[class*="tracking-[0.45"]') ||
                       q('[class*="tracking-[0.5"]')  ||
                       q('[class*="tracking-[0.4"]');
        const p      = q('p');
        const btns   = heroSection.querySelectorAll('.btn-gold, .btn-outline');
        const scroll = q('[class*="bottom-10"]');

        /* Immediately hide hero elements via set() */
        const toHide = [...h1s, p, scroll, ...btns].filter(Boolean);
        if (tag && !Array.from(h1s).some(h => h.contains(tag))) toHide.unshift(tag);

        gsap.set(toHide, { opacity: 0 });
        h1s.forEach(h => gsap.set(h, { y: 80 }));
        if (tag && !Array.from(h1s).some(h => h.contains(tag))) gsap.set(tag, { y: 28 });
        if (p)      gsap.set(p,  { y: 30 });
        if (scroll) gsap.set(scroll, { y: 10 });
        gsap.set([...btns], { y: 22 });

        /* Animate TO final state */
        const tl = gsap.timeline({ delay: .2 });

        if (tag && !Array.from(h1s).some(h => h.contains(tag))) {
            tl.to(tag, { opacity: 1, y: 0, duration: .7, ease: 'power3.out' });
        }

        h1s.forEach((h, i) => {
            tl.to(h, { opacity: 1, y: 0, duration: 1.1, ease: 'power4.out' },
                  i === 0 && tag ? '-=.4' : i === 0 ? 0 : '-=.7');
        });

        if (p)     tl.to(p,     { opacity: 1, y: 0, duration: .8, ease: 'power3.out' }, '-=.6');
        if (btns.length) tl.to([...btns], { opacity: 1, y: 0, stagger: .14, duration: .7, ease: 'power2.out' }, '-=.5');
        if (scroll) tl.to(scroll, { opacity: 1, y: 0, duration: .5 }, '-=.2');
    }

    /* ===========================================================
       5. SCROLL-TRIGGERED ANIMATIONS
          Excludes ALL elements inside heroSection via inHero().
    =========================================================== */
    function initScroll() {
        if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;
        gsap.registerPlugin(ScrollTrigger);

        const st = trigger => ({ trigger, start: 'top 88%', toggleActions: 'play none none none' });

        /* -- Headings outside hero -- */
        gsap.utils.toArray('h1, h2, h3, h4').forEach(el => {
            if (el.closest('#page-loader') || inHero(el)) return;
            gsap.from(el, {
                scrollTrigger: st(el),
                y: 65, opacity: 0, duration: 1, ease: 'power3.out',
            });
        });

        /* -- Paragraphs outside hero -- */
        gsap.utils.toArray('p').forEach(el => {
            if (el.closest('#page-loader') || inHero(el)) return;
            gsap.from(el, {
                scrollTrigger: { trigger: el, start: 'top 92%', toggleActions: 'play none none none' },
                y: 28, opacity: 0, duration: .8, ease: 'power2.out',
            });
        });

        /* -- Service glass cards (3D flip-in) -- */
        document.querySelectorAll('.glass-card').forEach((el, i) => {
            gsap.from(el, {
                scrollTrigger: st(el),
                y: 90, opacity: 0, rotateX: 20, scale: .96,
                duration: 1, delay: (i % 3) * .13, ease: 'power3.out',
                transformPerspective: 900,
            });
        });

        /* -- Portfolio cards -- */
        document.querySelectorAll('.portfolio-card').forEach((el, i) => {
            gsap.from(el, {
                scrollTrigger: { trigger: el, start: 'top 89%', toggleActions: 'play none none none' },
                y: 85, opacity: 0, rotateX: 14,
                duration: .9, delay: (i % 3) * .11, ease: 'power3.out',
                transformPerspective: 800,
            });
        });

        /* -- Pricing cards (alternating rotateY) -- */
        document.querySelectorAll('[class*="rounded-3xl"][class*="overflow-hidden"][class*="flex-col"]').forEach((el, i) => {
            gsap.from(el, {
                scrollTrigger: st(el),
                y: 80, opacity: 0, rotateY: (i % 2 === 0 ? -10 : 10),
                duration: 1.05, delay: i * .14, ease: 'power3.out',
                transformPerspective: 1100,
            });
        });

        /* -- List items stagger -- */
        document.querySelectorAll('ul').forEach(list => {
            if (list.closest('#page-loader') || inHero(list)) return;
            const items = list.querySelectorAll('li');
            if (!items.length) return;
            gsap.from(items, {
                scrollTrigger: { trigger: list, start: 'top 89%', toggleActions: 'play none none none' },
                x: -22, opacity: 0, stagger: .07, duration: .6, ease: 'power2.out',
            });
        });

        /* -- Footer columns stagger -- */
        const fCols = document.querySelectorAll('footer [class*="col-span"]');
        if (fCols.length) {
            gsap.from(fCols, {
                scrollTrigger: { trigger: 'footer', start: 'top 90%', toggleActions: 'play none none none' },
                y: 45, opacity: 0, stagger: .12, duration: .9, ease: 'power2.out',
            });
        }

        /* -- Badge pills scale-pop -- */
        document.querySelectorAll('[class*="rounded-full"][class*="amber-500"][class*="border"]').forEach(el => {
            if (el.closest('#page-loader') || inHero(el)) return;
            gsap.from(el, {
                scrollTrigger: { trigger: el, start: 'top 92%', toggleActions: 'play none none none' },
                scale: .65, opacity: 0, duration: .55, ease: 'back.out(2.5)',
            });
        });

        /* -- Sections subtle fade (skip hero at index 0) -- */
        gsap.utils.toArray('section').forEach((s, i) => {
            if (i === 0) return;
            gsap.from(s, {
                scrollTrigger: { trigger: s, start: 'top 97%', toggleActions: 'play none none none' },
                opacity: 0, y: 18, duration: .55, ease: 'power1.out',
            });
        });

        /* -- Hero image parallax on scroll -- */
        const heroBg = heroSection ? heroSection.querySelector('.animate-slow-zoom') : null;
        if (heroBg) {
            gsap.to(heroBg, {
                scrollTrigger: {
                    trigger: heroSection,
                    start: 'top top', end: 'bottom top', scrub: true,
                },
                y: 170, ease: 'none',
            });
        }

        /* -- Workflow steps on services page -- */
        document.querySelectorAll('.max-w-5xl > .space-y-16 > div, .max-w-5xl > .space-y-32 > div').forEach((el, i) => {
            gsap.from(el, {
                scrollTrigger: { trigger: el, start: 'top 86%', toggleActions: 'play none none none' },
                x: i % 2 === 0 ? -55 : 55, opacity: 0, duration: 1, ease: 'power3.out',
            });
        });

        /* -- Expertise grid columns -- */
        document.querySelectorAll('.divide-y > div, .divide-x > div').forEach((el, i) => {
            gsap.from(el, {
                scrollTrigger: { trigger: el, start: 'top 89%', toggleActions: 'play none none none' },
                y: 40, opacity: 0, duration: .8, delay: i * .1, ease: 'power2.out',
            });
        });
    }

    /* ===========================================================
       6. 3D CARD TILT (mouse tracking)
    =========================================================== */
    function initTilt() {
        if (typeof gsap === 'undefined' || isMobile) return;

        function applyTilt(selector, maxRot) {
            document.querySelectorAll(selector).forEach(card => {
                if (!card.querySelector('.tilt-shine')) {
                    const sh = document.createElement('div');
                    sh.className = 'tilt-shine';
                    card.appendChild(sh);
                }
                card.addEventListener('mousemove', e => {
                    const r    = card.getBoundingClientRect();
                    const xPct = (e.clientX - r.left) / r.width  - .5;
                    const yPct = (e.clientY - r.top)  / r.height - .5;
                    gsap.to(card, {
                        rotateX: -yPct * maxRot, rotateY: xPct * maxRot,
                        scale: 1.03, transformPerspective: 1000,
                        ease: 'power1.out', duration: .25,
                    });
                    const sh = card.querySelector('.tilt-shine');
                    if (sh) sh.style.background = `radial-gradient(circle at ${(xPct + .5) * 100}% ${(yPct + .5) * 100}%, rgba(245,158,11,.13) 0%, transparent 58%)`;
                });
                card.addEventListener('mouseleave', () => {
                    gsap.to(card, { rotateX: 0, rotateY: 0, scale: 1, duration: .75, ease: 'elastic.out(1,.75)' });
                    const sh = card.querySelector('.tilt-shine');
                    if (sh) sh.style.background = 'none';
                });
            });
        }

        applyTilt('.glass-card', 12);
        applyTilt('.portfolio-card', 9);
        applyTilt('[class*="rounded-3xl"][class*="overflow-hidden"][class*="flex-col"]', 6);
    }

    /* ===========================================================
       7. MAGNETIC BUTTONS
    =========================================================== */
    function initMagnetic() {
        if (typeof gsap === 'undefined' || isMobile) return;
        document.querySelectorAll('.btn-gold, .btn-outline').forEach(btn => {
            btn.addEventListener('mousemove', e => {
                const r = btn.getBoundingClientRect();
                gsap.to(btn, {
                    x: (e.clientX - r.left - r.width  / 2) * .3,
                    y: (e.clientY - r.top  - r.height / 2) * .3,
                    duration: .3, ease: 'power1.out',
                });
            });
            btn.addEventListener('mouseleave', () => {
                gsap.to(btn, { x: 0, y: 0, duration: .75, ease: 'elastic.out(1,.7)' });
            });
        });
    }

    /* ===========================================================
       8. AMBIENT GLOW PULSE
    =========================================================== */
    function initGlows() {
        if (typeof gsap === 'undefined') return;
        document.querySelectorAll('[class*="blur-[150px]"], [class*="blur-[180px]"], [class*="blur-[120px]"]').forEach((el, i) => {
            gsap.to(el, {
                scale: 1.25, opacity: .6,
                x: i % 2 === 0 ? 30 : -30,
                y: i % 2 === 0 ? -20 : 20,
                duration: 6 + i * 1.2,
                repeat: -1, yoyo: true, ease: 'sine.inOut', delay: i * .7,
            });
        });

        /* Float "Recommended" banner */
        document.querySelectorAll('[class*="bg-amber-500"][class*="py-3"][class*="text-center"]').forEach(el => {
            gsap.to(el, { y: -3, duration: 2.5, repeat: -1, yoyo: true, ease: 'sine.inOut' });
        });
    }

    /* ===========================================================
       9. FOOTER SOCIAL ICONS 3D FLIP
    =========================================================== */
    function initSocialIcons() {
        if (typeof gsap === 'undefined' || isMobile) return;
        document.querySelectorAll('footer a').forEach(el => {
            if (!el.className.includes('w-12') && !el.className.includes('h-12')) return;
            el.addEventListener('mouseenter', () => gsap.to(el, { rotateY: 180, scale: 1.15, duration: .4, ease: 'power2.out' }));
            el.addEventListener('mouseleave', () => gsap.to(el, { rotateY: 0, scale: 1,    duration: .5, ease: 'power2.out' }));
        });
    }

    /* ===========================================================
       10. NAV LOGO 3D TILT
    =========================================================== */
    function initNavLogo() {
        if (typeof gsap === 'undefined' || isMobile) return;
        const logo = document.querySelector('header a.group');
        if (!logo) return;
        logo.addEventListener('mousemove', e => {
            const r = logo.getBoundingClientRect();
            gsap.to(logo, {
                rotateY:  ((e.clientX - r.left) / r.width  - .5) * 14,
                rotateX: -((e.clientY - r.top)  / r.height - .5) * 10,
                scale: 1.05, transformPerspective: 600, duration: .25,
            });
        });
        logo.addEventListener('mouseleave', () => gsap.to(logo, { rotateY: 0, rotateX: 0, scale: 1, duration: .6, ease: 'elastic.out(1,.8)' }));
    }

    /* ===========================================================
       BOOT — heroEntrance runs BEFORE initScroll so initial
       states are locked before ScrollTrigger evaluates them.
    =========================================================== */
    document.addEventListener('DOMContentLoaded', () => {
        if (reduced) return;

        const boot = () => {
            heroEntrance();   /* ← FIRST: lock hero initial states */
            initScroll();     /* ← SECOND: scroll triggers (excludes hero via inHero()) */
            initParticles();
            initCursor();
            initTilt();
            initMagnetic();
            initGlows();
            initSocialIcons();
            initNavLogo();
        };

        boot();
    });

})();
