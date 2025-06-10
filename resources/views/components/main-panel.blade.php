<div class="hero-section bg-night-dark bg-hero bg-cover bg-center bg-no-repeat bg-fixed">
    <div class="absolute inset-0 bg-night-dark/70 z-0"></div>
    
    <nav class="bg-transparent relative z-30">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <a class="text-star-white font-mono hover:text-star-cyan transition-colors duration-300 relative z-40" href="{{ route('home.index') }}">Inicio</a>
                
                <!-- Menú de escritorio -->
                <div class="hidden md:flex md:items-center relative z-40">
                    <ul class="flex space-x-6">
                        <li>
                            <a class="text-star-cyan hover:text-sky-400 transition-colors duration-300 font-medium" href="{{ route('projects.index') }}">Proyectos</a>
                        </li>
                        <li>
                            <a class="text-star-orange hover:text-amber-400 transition-colors duration-300 font-medium" href="{{ route('blog.index') }}">Blog</a>
                        </li>
                        <li>
                            <a class="text-star-white hover:text-star-white-light font-medium" href="{{ route('contact.index') }}">Contacto</a>
                        </li>
                    </ul>
                </div>
                
                <!-- Botón hamburguesa -->
                <button class="md:hidden text-star-white focus:outline-none relative z-40" type="button" onclick="toggleMenu()" aria-label="Toggle navigation" id="menu-button">
                    <svg class="w-6 h-6" id="menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg class="w-6 h-6 hidden" id="close-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Menú móvil -->
            <div class="md:hidden hidden absolute top-full left-0 right-0 bg-night-dark border-t border-star-cyan z-50 shadow-lg" id="mobileMenu">
                <ul class="px-4 py-4 space-y-4">
                    <li>
                        <a class="text-star-cyan hover:text-star-cyan-light block py-2 text-lg" href="{{ route('projects.index') }}">Proyectos</a>
                    </li>
                    <li>
                        <a class="text-star-orange hover:text-star-orange-light block py-2 text-lg" href="{{ route('blog.index') }}">Blog</a>
                    </li>
                    <li>
                        <a class="text-star-white hover:text-star-white-light block py-2 text-lg" href="{{ route('contact.index') }}">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container mx-auto h-full py-20 relative z-10">
        <div class="flex items-center justify-center h-full">
            <div class="text-center">
                <h1 class="text-5xl md:text-7xl title-star-white mb-4">{{ $hero_title }}</h1>
                <p class="text-lg md:text-md text-star-white-light mb-3">{{ $hero_subtitle }}</p>
            </div>
        </div>
    </div>
</div>

<script>
// El mismo código JavaScript que teníamos antes
function toggleMenu() {
    const mobileMenu = document.getElementById('mobileMenu');
    const menuIcon = document.getElementById('menu-icon');
    const closeIcon = document.getElementById('close-icon');
    
    mobileMenu.classList.toggle('hidden');
    menuIcon.classList.toggle('hidden');
    closeIcon.classList.toggle('hidden');
}

document.addEventListener('DOMContentLoaded', function() {
    const menuLinks = document.querySelectorAll('#mobileMenu a');
    const mobileMenu = document.getElementById('mobileMenu');
    const menuIcon = document.getElementById('menu-icon');
    const closeIcon = document.getElementById('close-icon');
    
    menuLinks.forEach(link => {
        link.addEventListener('click', function() {
            mobileMenu.classList.add('hidden');
            menuIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
        });
    });
    
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
            mobileMenu.classList.add('hidden');
            menuIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
        }
    });
    
    document.addEventListener('click', function(event) {
        const nav = document.querySelector('nav');
        const menuButton = document.getElementById('menu-button');
        
        if (!nav.contains(event.target) && !menuButton.contains(event.target)) {
            mobileMenu.classList.add('hidden');
            menuIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
        }
    });
});
</script>