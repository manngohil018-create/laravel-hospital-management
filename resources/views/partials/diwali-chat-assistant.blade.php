<style>
.diwali-banner {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 9px 16px;
    background: #fff7e6;
    border-bottom: 1px solid #edc77a;
    color: #47321a;
    text-align: center;
    font-size: 13px;
    font-weight: 600;
}

.diwali-lamp {
    position: relative;
    display: inline-grid;
    width: 40px;
    height: 40px;
    flex: 0 0 40px;
    place-items: center;
    padding: 0;
    border: 0;
    border-radius: 50%;
    background: transparent;
    cursor: pointer;
    font-size: 24px;
}

.diwali-lamp-icon {
    display: block;
    transform-origin: 50% 70%;
    animation: diya-flicker 2.2s ease-in-out infinite;
}

.diwali-lamp:focus-visible {
    outline: 3px solid #a34a08;
    outline-offset: 2px;
}

.diwali-lamp.is-lit {
    animation: diya-bloom 1.2s ease-out;
}

.diwali-lamp.is-lit .diwali-lamp-icon {
    animation: diya-flare .75s ease-out;
}

.diwali-lamp.is-lit::after {
    position: absolute;
    top: -4px;
    right: -3px;
    color: #e19a20;
    content: '✦';
    pointer-events: none;
    animation: diya-spark 1s ease-out forwards;
}

@keyframes diya-flicker {
    0%, 100% { transform: rotate(-2deg) scale(1); }
    50% { transform: rotate(2deg) scale(1.05); }
}

@keyframes diya-bloom {
    0% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0); }
    35% { box-shadow: 0 0 0 12px rgba(245, 158, 11, .26), 0 0 28px 12px rgba(245, 158, 11, .34); }
    100% { box-shadow: 0 0 0 24px rgba(245, 158, 11, 0); }
}

@keyframes diya-flare {
    0%, 100% { transform: scale(1) rotate(0); }
    35% { transform: scale(1.45) rotate(-8deg); }
    70% { transform: scale(1.2) rotate(6deg); }
}

@keyframes diya-spark {
    0% { opacity: 0; transform: translate(0, 8px) scale(.4); }
    30% { opacity: 1; transform: translate(2px, -2px) scale(1.2); }
    100% { opacity: 0; transform: translate(5px, -17px) scale(.5); }
}

body > header {
    background: #312e4b;
    border-bottom: 3px solid #e6a23c;
    position: relative;
    top: auto;
    z-index: 1;
}

body > header nav {
    position: relative;
}

body > header .nav-links a {
    position: relative;
    display: inline-block;
    padding: 5px 0;
    text-decoration: none;
}

body > header .nav-links a::after {
    position: absolute;
    right: 0;
    bottom: 0;
    left: 0;
    height: 2px;
    background: #f2c56b;
    content: '';
    transform: scaleX(0);
    transform-origin: left;
    transition: transform .2s ease;
}

body > header .nav-links a:hover::after,
body > header .nav-links a[aria-current="page"]::after {
    transform: scaleX(1);
}

.lifecare-nav-toggle {
    display: none;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 9px 12px;
    border: 1px solid rgba(255, 255, 255, .55);
    border-radius: 6px;
    background: transparent;
    color: #fff;
    cursor: pointer;
    font: 600 14px 'Poppins', sans-serif;
}

.lifecare-nav-toggle:focus-visible,
body > header .nav-links a:focus-visible {
    outline: 3px solid #f2c56b;
    outline-offset: 4px;
}

footer {
    background: #312e4b;
    border-top: 3px solid #e6a23c;
}

.btn-primary,
.btn-cta {
    background: #b45309;
    border-color: #b45309;
}

.lifecare-whatsapp-link {
    position: fixed;
    right: 24px;
    bottom: 24px;
    z-index: 1100;
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 13px 18px;
    border: 2px solid #f2c56b;
    border-radius: 28px;
    background: #128c7e;
    color: #fff;
    box-shadow: 0 5px 18px rgba(0, 0, 0, .22);
    font: 600 15px 'Poppins', sans-serif;
    text-decoration: none;
}

.lifecare-whatsapp-link:hover {
    background: #0e766a;
}

.lifecare-whatsapp-link:focus-visible {
    outline: 3px solid #f2b84b;
    outline-offset: 3px;
}

@media (max-width: 480px) {
    .diwali-banner {
        padding: 8px 10px;
        font-size: 12px;
    }

    .diwali-lamp {
        width: 34px;
        height: 34px;
        flex-basis: 34px;
        font-size: 21px;
    }

    .lifecare-whatsapp-link {
        right: 16px;
        bottom: 16px;
    }
}

@media (max-width: 768px) {
    body > header .lifecare-nav-toggle {
        display: inline-flex;
    }

    body > header .nav-links.lifecare-nav-open {
        position: absolute;
        top: calc(100% + 10px);
        right: 16px;
        left: 16px;
        z-index: 101;
        display: flex;
        flex-direction: column;
        gap: 2px;
        padding: 8px;
        border: 1px solid rgba(242, 197, 107, .55);
        border-radius: 10px;
        background: #312e4b;
        box-shadow: 0 12px 30px rgba(17, 24, 39, .24);
    }

    body > header .nav-links.lifecare-nav-open a {
        display: block;
        padding: 10px 12px;
        border-radius: 5px;
    }

    body > header .nav-links.lifecare-nav-open a:hover,
    body > header .nav-links.lifecare-nav-open a[aria-current="page"] {
        background: rgba(242, 197, 107, .15);
    }

    body > header .nav-links.lifecare-nav-open a::after {
        content: none;
    }
}

@media (prefers-reduced-motion: reduce) {
    body > header .nav-links a::after {
        transition: none;
    }

    .diwali-lamp-icon {
        animation: none;
    }

    .diwali-lamp.is-lit,
    .diwali-lamp.is-lit .diwali-lamp-icon,
    .diwali-lamp.is-lit::after {
        animation: none;
    }
}
</style>

<div class="diwali-banner" role="note">
    <button class="diwali-lamp" id="diwali-lamp" type="button" aria-label="Light the Diwali diya">
        <span class="diwali-lamp-icon" aria-hidden="true">🪔</span>
    </button>
    Happy Diwali from LifeCare Hospital — wishing you health, light, and happiness.
</div>

<a class="lifecare-whatsapp-link" href="https://wa.me/917940204020?text=Hello%20LifeCare%20Hospital%2C%20I%20would%20like%20some%20information." target="_blank" rel="noopener noreferrer" aria-label="Chat with LifeCare Hospital on WhatsApp">
    <i class="fab fa-whatsapp" aria-hidden="true"></i>
    <span>Chat on WhatsApp</span>
</a>

<script>
(() => {
    const lamp = document.getElementById('diwali-lamp');
    if (!lamp) {
        throw new Error('Diwali diya control could not initialize.');
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('body > header nav').forEach((nav, index) => {
            const links = nav.querySelector('.nav-links');
            if (!links) return;

            const toggle = document.createElement('button');
            const menuId = `lifecare-navigation-${index + 1}`;
            links.id = menuId;
            toggle.className = 'lifecare-nav-toggle';
            toggle.type = 'button';
            toggle.setAttribute('aria-controls', menuId);
            toggle.setAttribute('aria-expanded', 'false');
            toggle.innerHTML = '<i class="fas fa-bars" aria-hidden="true"></i><span>Menu</span>';
            nav.insertBefore(toggle, links.nextSibling);

            const closeMenu = () => {
                links.classList.remove('lifecare-nav-open');
                toggle.setAttribute('aria-expanded', 'false');
                toggle.innerHTML = '<i class="fas fa-bars" aria-hidden="true"></i><span>Menu</span>';
            };

            toggle.addEventListener('click', () => {
                const isOpen = toggle.getAttribute('aria-expanded') !== 'true';
                links.classList.toggle('lifecare-nav-open', isOpen);
                toggle.setAttribute('aria-expanded', String(isOpen));
                toggle.innerHTML = isOpen
                    ? '<i class="fas fa-times" aria-hidden="true"></i><span>Close</span>'
                    : '<i class="fas fa-bars" aria-hidden="true"></i><span>Menu</span>';
            });

            links.querySelectorAll('a').forEach((link) => {
                const linkPath = new URL(link.href, window.location.href).pathname.replace(/\/+$/, '') || '/';
                const currentPath = window.location.pathname.replace(/\/+$/, '') || '/';
                if (linkPath === currentPath) link.setAttribute('aria-current', 'page');
                link.addEventListener('click', closeMenu);
            });

            nav.addEventListener('keydown', (event) => {
                if (event.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') {
                    closeMenu();
                    toggle.focus();
                }
            });
        });
    });

    let animationTimer;
    lamp.addEventListener('click', () => {
        window.clearTimeout(animationTimer);
        lamp.classList.remove('is-lit');
        void lamp.offsetWidth;
        lamp.classList.add('is-lit');
        animationTimer = window.setTimeout(() => lamp.classList.remove('is-lit'), 1300);
    });
})();
</script>
