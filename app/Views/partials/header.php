<header>
    <nav>
        <ul id="main-nav">
            <li>
                <a href="/" class="nav-link">
                    <span class="icon" aria-hidden="true" style="vertical-align:middle; margin-right:7px;">
                        <svg width="20" height="20" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M3 12L12 3l9 9"/><path d="M9 21V9h6v12"/></svg>
                    </span>
                    Home
                    <span class="checkmark"></span>
                </a>
            </li>
            <li>
                <a href="/sobre" class="nav-link">
                    <span class="icon" aria-hidden="true" style="vertical-align:middle; margin-right:7px;">
                        <svg width="20" height="20" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                    </span>
                    Sobre
                    <span class="checkmark"></span>
                </a>
            </li>
                <li><a href="/documentacao" class="nav-link">Documentação</a></li>
        </ul>
    </nav>
    <style>
        #main-nav {
            gap: 2rem;
        }
        .nav-link {
            position: relative;
            display: flex;
            align-items: center;
            padding-right: 2.2rem;
        }
        .nav-link .checkmark {
            display: none;
            position: absolute;
            right: 0.7rem;
            top: 50%;
            transform: translateY(-50%);
            color: #00e676;
        }
        .nav-link.active .checkmark {
            display: inline-block;
        }
        .nav-link.active {
            background: #00bcd4;
            color: #fff;
        }
        .nav-link .icon svg {
            display: inline;
            vertical-align: middle;
        }
    </style>
    <script>
        // Marca o item ativo baseado na URL
        document.addEventListener('DOMContentLoaded', function() {
            var links = document.querySelectorAll('#main-nav .nav-link');
            var current = window.location.pathname.replace(/\/$/, '');
            links.forEach(function(link) {
                var href = link.getAttribute('href').replace(/\/$/, '');
                if (href === current || (href === '' && current === '')) {
                    link.classList.add('active');
                    // Adiciona o ícone de check
                    link.querySelector('.checkmark').innerHTML = '<svg width="18" height="18" fill="none" stroke="#00e676" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="20 6 10 18 4 12"/></svg>';
                }
            });
        });
    </script>
</header>
