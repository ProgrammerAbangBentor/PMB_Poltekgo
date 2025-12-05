<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PMB Politeknik Gorontalo</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- ===================== SEO & OG TAGS ===================== -->
    <meta name="description"
        content="Penerimaan Mahasiswa Baru Politeknik Gorontalo. Mulai perjalanan masa depanmu bersama pendidikan vokasi terbaik. Daftar sekarang!">
    <meta name="keywords" content="PMB Politeknik Gorontalo, Pendaftaran Mahasiswa Baru, Poltekgo, Kampus Gorontalo">
    <meta name="author" content="Politeknik Gorontalo">

    <!-- OPEN GRAPH UNTUK SHARE WHATSAPP -->
    <meta property="og:title" content="PMB Politeknik Gorontalo">
    <meta property="og:description"
        content="Daftar sekarang dan mulailah perjalanan pendidikan terbaikmu bersama Politeknik Gorontalo.">
    <meta property="og:image" content="{{ asset('img/campus.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">

    <!-- AOS (SCROLL ANIMATION) -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --gold: #F7C948;
            --gold-bold: #FFB300;
        }

        html,
        body {
            max-width: 100%;
            overflow-x: hidden !important;
        }

        .gold {
            color: var(--gold);
        }

        .btn-gold {
            background-color: var(--gold);
            color: #4A148C;
            font-weight: bold;
        }

        .btn-gold:hover {
            background-color: var(--gold-bold);
        }

        .navbar-active {
            background: rgba(60, 0, 120, 0.75);
            backdrop-filter: blur(12px);
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body class="text-white bg-purple-900 overflow-x-hidden">

    <!-- ===================== NAVBAR ===================== -->
    <nav id="navbar" class="fixed top-0 w-full z-50 transition duration-300">
        <div class="max-w-6xl mx-auto px-5 py-4 flex items-center justify-between">

            <div class="flex items-center gap-2">
                <img src="{{ asset('logo/logo-politeknik-gorontalo.png') }}"
                    class="h-10 w-10 object-contain drop-shadow-md" alt="Logo">
                <span class="font-semibold text-lg tracking-wide gold">Politeknik Gorontalo</span>
            </div>

            <div class="hidden md:flex gap-8 text-sm font-medium">
                <a href="#home" class="hover:text-[var(--gold)] transition">Beranda</a>
                <a href="#why" class="hover:text-[var(--gold)] transition">Keunggulan</a>
                <a href="#info" class="hover:text-[var(--gold)] transition">Informasi</a>
            </div>

            <a href="{{ route('login') }}" class="hidden md:block px-5 py-2 btn-gold rounded-lg shadow">Login</a>

            <button id="menuBtn" class="md:hidden text-3xl transition select-none">☰</button>
        </div>

        <!-- MOBILE MENU -->
        <div id="mobileMenu" class="hidden md:hidden flex-col bg-purple-900/95 backdrop-blur-lg px-6 py-4 space-y-4">
            <a href="#home" class="block hover:text-[var(--gold)]">Beranda</a>
            <a href="#why" class="block hover:text-[var(--gold)]">Keunggulan</a>
            <a href="#info" class="block hover:text-[var(--gold)]">Informasi</a>

            <a href="{{ route('login') }}"
                class="block py-2 px-4 btn-gold rounded-lg text-center font-semibold">Login</a>
        </div>
    </nav>

    <!-- ===================== HERO VIDEO ===================== -->
    <section id="home" class="relative w-full overflow-hidden bg-purple-900/80 pt-[90px]">

        <!-- TEKS AJAKAN + TOMBOL -->
        <div
            class="absolute top-1/2 left-1/2 z-20 transform -translate-x-1/2 -translate-y-1/2 
                w-full max-w-[90%] md:max-w-3xl px-4 text-center">

            <p class="text-purple-100 text-xl md:text-3xl font-semibold mb-6 drop-shadow-lg leading-snug">
                Mulai perjalanan masa depanmu bersama Politeknik Gorontalo.
            </p>

            <a href="{{ route('register') }}"
                class="inline-block px-8 py-3 rounded-xl font-bold text-lg 
                  bg-[var(--gold)] text-purple-900 shadow-2xl 
                  hover:bg-[var(--gold-bold)] transition">
                Daftar Sekarang
            </a>
        </div>

        <!-- VIDEO RESPONSIVE -->
        <video autoplay muted loop playsinline preload="metadata"
            class="w-full aspect-[9/16] md:aspect-[16/9] object-cover brightness-75">
            <source src="{{ asset('pmb.mp4') }}" type="video/mp4">
        </video>

        <div class="absolute inset-0 bg-gradient-to-b from-black/20 to-black/40 pointer-events-none"></div>
    </section>


    <!-- ===================== KEUNGGULAN ===================== -->
    <section id="why" class="py-16 bg-purple-950">
        <div class="max-w-5xl mx-auto px-6 text-center">

            <h2 class="text-3xl font-bold mb-12 gold" data-aos="fade-up">
                Mengapa Memilih Poltekgo?
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div data-aos="fade-up"
                    class="p-6 bg-white/10 hover:bg-white/20 transition 
                    rounded-xl shadow-lg border-l-4 border-[var(--gold)]">
                    <h3 class="font-semibold text-xl mb-2 gold">Kurikulum Vokasi</h3>
                    <p class="text-purple-200 text-sm">Pembelajaran berbasis praktik siap kerja.</p>
                </div>

                <div data-aos="fade-up" data-aos-delay="200"
                    class="p-6 bg-white/10 hover:bg-white/20 transition rounded-xl shadow-lg border-l-4 border-[var(--gold)]">
                    <h3 class="font-semibold text-xl mb-2 gold">Dosen Profesional</h3>
                    <p class="text-purple-200 text-sm">Pengajar berpengalaman & ahli industri.</p>
                </div>

                <div data-aos="fade-up" data-aos-delay="400"
                    class="p-6 bg-white/10 hover:bg-white/20 transition rounded-xl shadow-lg border-l-4 border-[var(--gold)]">
                    <h3 class="font-semibold text-xl mb-2 gold">Sarana Modern</h3>
                    <p class="text-purple-200 text-sm">Fasilitas laboratorium lengkap & modern.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- ===================== INFORMASI ===================== -->
    <section id="info" class="py-16 bg-purple-900/95">
        <div class="max-w-4xl mx-auto px-6 text-center">

            <h2 class="text-3xl font-bold mb-6 gold" data-aos="fade-up">Informasi PMB</h2>

            <p class="text-purple-200 text-md leading-relaxed" data-aos="fade-up" data-aos-delay="200">
                Pendaftaran dilakukan secara online.
                Calon mahasiswa dapat memilih program studi, mengisi data lengkap, mengunggah berkas,
                dan mengikuti tahapan seleksi penerimaan mahasiswa baru.
            </p>

        </div>
    </section>

    <!-- ===================== FOOTER ===================== -->
    <footer class="py-6 text-center bg-purple-950 text-purple-300 text-sm">
        <span class="gold">PMB Politeknik Gorontalo</span> © {{ date('Y') }}
    </footer>

    <!-- ===================== SCRIPT ===================== -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();

        const navbar = document.getElementById("navbar");
        const menuBtn = document.getElementById("menuBtn");
        const mobileMenu = document.getElementById("mobileMenu");

        window.addEventListener("scroll", () => {
            navbar.classList.toggle("navbar-active", window.scrollY > 20);
        });

        menuBtn.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
            menuBtn.textContent = mobileMenu.classList.contains("hidden") ? "☰" : "✖";
        });

        document.querySelectorAll("a[href^='#']").forEach(link => {
            link.addEventListener("click", function(e) {
                const target = document.querySelector(this.getAttribute("href"));
                if (target) {
                    e.preventDefault();
                    window.scrollTo({
                        top: target.offsetTop - 80,
                        behavior: "smooth"
                    });

                    if (!mobileMenu.classList.contains("hidden")) {
                        mobileMenu.classList.add("hidden");
                        menuBtn.textContent = "☰";
                    }
                }
            });
        });
    </script>

</body>

</html>
