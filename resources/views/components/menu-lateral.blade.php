<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Lateral com Ícones</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/heroicons@1.0.6/dist/heroicons.min.css">
    <style>
        .submenu {
            transition: max-height 0.3s ease-out, opacity 0.3s ease-out;
            max-height: 0;
            opacity: 0;
            overflow: hidden;
        }
        .submenu.open {
            max-height: 200px;
            opacity: 1;
        }
        .rotate-180 {
            transform: rotate(180deg);
        }
        .transition-transform {
            transition: transform 0.3s ease-out;
        }
    </style>
</head>
<body class="bg-gray-100 h-screen overflow-hidden">
    <div class="flex h-screen">
        <!-- Menu Lateral -->
        <div class="w-56 bg-gray-800 text-white h-screen">
            <ul class="list-none p-0 m-0">
                <li class="border-b border-gray-700">
                    <a href="{{ route('banner.index') }}" class="block p-4 hover:bg-gray-700 flex items-center cursor-pointer">
                        <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12h18M3 6h18M3 18h18"></path>
                        </svg>
                        Banners
                    </a>
                </li>
                <li class="border-b border-gray-700">
                    <a href="{{ route('galeria.index') }}" class="block p-4 hover:bg-gray-700 flex items-center cursor-pointer">
                        <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h12"></path>
                        </svg>
                        Galeria
                    </a>
                </li>
                <li class="border-b border-gray-700">
                    <a href="{{ route('textos.index') }}" class="block p-4 hover:bg-gray-700 flex items-center cursor-pointer">
                        <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.5-4.5m0 0L19 7m0-2l-4.5 4.5M9 15L4.5 19m0 0L5 16m-1 1L9 15m-4-3h12"></path>
                        </svg>
                        Textos
                    </a>
                </li>
                <li class="border-b border-gray-700">
                    <a href="{{ route('bazar.index') }}" class="block p-4 hover:bg-gray-700 flex items-center cursor-pointer">
                        <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m-6-8h6m-9 4H4a2 2 0 00-2 2v4a2 2 0 002 2h1m4 0h6v-6H9v6z"></path>
                        </svg>
                        Bazar
                    </a>
                </li>
                <li class="border-b border-gray-700">
                    <a id="toggleOutros" class="block p-4 hover:bg-gray-700 cursor-pointer flex items-center">
                        <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        Outros
                        <svg id="arrowIcon" class="h-5 w-5 ml-auto transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                    <ul id="subMenuOutros" class="submenu pl-6">
                        <li><a href="#" class="block p-4 hover:bg-gray-600">Subitem 1</a></li>
                        <li><a href="#" class="block p-4 hover:bg-gray-600">Subitem 2</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    <!-- JavaScript -->
    <script>
        document.getElementById('toggleOutros').addEventListener('click', function() {
            const subMenu = document.getElementById('subMenuOutros');
            const arrowIcon = document.getElementById('arrowIcon');
            subMenu.classList.toggle('open');
            arrowIcon.classList.toggle('rotate-180');
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
