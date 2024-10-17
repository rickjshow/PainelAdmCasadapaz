<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Lateral com Ícones</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
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

        a {
            text-decoration: none;
            color: white;
        }
        a:hover {
            text-decoration: none;
            background-color: #4b5563;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Menu Lateral -->
        <div class="w-56 bg-gray-800 text-white h-full"> <!-- h-full para ocupar 100% da altura -->
            <ul class="list-none p-0 m-0">
                <li class="border-b border-gray-700">
                    <a href="{{ route('sobre-nos.index') }}" class="block p-4 flex items-center cursor-pointer">
                        <i class="fas fa-info-circle mr-3"></i>
                        Sobre Nós
                    </a>
                </li>
                <li class="border-b border-gray-700">
                    <a href="{{ route('como-ajudar.index') }}" class="block p-4 flex items-center cursor-pointer">
                        <i class="fas fa-hands-helping mr-3"></i>
                        Como Ajudar
                    </a>
                </li>
                <li class="border-b border-gray-700">
                    <a href="{{ route('doacao.index') }}" class="block p-4 flex items-center cursor-pointer">
                        <i class="fas fa-donate mr-3"></i>
                        Doações
                    </a>
                </li>
                <li class="border-b border-gray-700">
                    <a href="{{ route('galeria.index') }}" class="block p-4 flex items-center cursor-pointer">
                        <i class="fas fa-images mr-3"></i>
                        Galeria
                    </a>
                </li>
                <li class="border-b border-gray-700">
                    <a href="{{ route('bazar.index') }}" class="block p-4 flex items-center cursor-pointer">
                        <i class="fas fa-shopping-basket mr-3"></i>
                        Bazar
                    </a>
                </li>
                <li class="border-b border-gray-700">
                    <a href="{{ route('premios.index') }}" class="block p-4 flex items-center cursor-pointer">
                        <i class="fas fa-trophy mr-3"></i>
                        Prêmios
                    </a>
                </li>
                <li class="border-b border-gray-700">
                    <a href="{{ route('contato.index') }}" class="block p-4 flex items-center cursor-pointer">
                        <i class="fas fa-envelope mr-3"></i>
                        Contato
                    </a>
                </li>
            </ul>
        </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
