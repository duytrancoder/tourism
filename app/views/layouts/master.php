<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VietTravel - Tour Booking System</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        teal: {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            200: '#99f6e4',
                            300: '#5eead4',
                            400: '#2dd4bf',
                            500: '#14b8a6',
                            600: '#0d9488',
                            700: '#0f766e',
                            800: '#115e59',
                            900: '#134e4a',
                            950: '#042f2e',
                        },
                        rose: {
                            500: '#f43f5e',
                            600: '#e11d48',
                        }
                    }
                }
            }
        }
    </script>
    <!-- Lucide Icons via CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="min-h-screen bg-gray-50 flex flex-col font-sans">
    
    <!-- Header -->
    <header class="sticky top-0 z-40 bg-white/90 backdrop-blur-md shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="<?= BASE_URL ?>" class="flex items-center space-x-2">
                    <div class="bg-teal-500 text-white p-2 rounded-lg">
                        <i data-lucide="map-pin"></i>
                    </div>
                    <span class="text-xl font-bold text-teal-900 tracking-tight">
                        VietTravel
                    </span>
                </a>

                <!-- Desktop Nav -->
                <nav class="hidden md:flex space-x-8">
                    <a href="<?= BASE_URL ?>" class="text-sm font-medium text-gray-600 hover:text-teal-500 transition-colors">Trang chủ</a>
                    <a href="<?= BASE_URL ?>package" class="text-sm font-medium text-gray-600 hover:text-teal-500 transition-colors">Danh sách Tour</a>
                    <a href="<?= BASE_URL ?>page/contact" class="text-sm font-medium text-gray-600 hover:text-teal-500 transition-colors">Liên hệ</a>
                </nav>

                <!-- User Actions -->
                <div class="hidden md:flex items-center space-x-4">
                    <?php if (isset($_SESSION['login']) && !empty($_SESSION['login'])): ?>
                        <div class="flex items-center space-x-4">
                            <a href="<?= BASE_URL ?>wishlist" class="relative text-gray-600 hover:text-rose-500 transition-colors">
                                <i data-lucide="heart" class="w-5 h-5"></i>
                            </a>
                            <div class="relative group">
                                <button class="flex items-center space-x-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 px-3 py-2 rounded-full transition-colors">
                                    <i data-lucide="user" class="w-4 h-4"></i>
                                    <span><?= htmlentities($_SESSION['login']) ?></span>
                                </button>
                                <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 origin-top-right z-50 border border-gray-100">
                                    <a href="<?= BASE_URL ?>tour/history" class="block px-4 py-2 text-sm text-gray-700 hover:bg-teal-50 hover:text-teal-700">Lịch sử đặt tour</a>
                                    <a href="<?= BASE_URL ?>user/logout" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center">
                                        <i data-lucide="log-out" class="w-4 h-4 mr-2"></i> Đăng xuất
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="<?= BASE_URL ?>" class="bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium px-5 py-2 rounded-full transition-colors shadow-sm hover:shadow-md">
                            Đăng nhập
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button class="text-gray-600 hover:text-teal-600 focus:outline-none">
                        <i data-lucide="menu"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1">
        <?= $content ?>
    </main>

    <!-- Footer -->
    <footer class="bg-teal-900 text-teal-100 py-12 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-2xl font-bold text-white mb-4 flex items-center gap-2">
                        <span class="bg-teal-500 p-1 rounded">
                            <i data-lucide="map-pin" class="w-6 h-6 text-white"></i>
                        </span>
                        VietTravel
                    </h3>
                    <p class="text-teal-200/80 mb-6 max-w-sm leading-relaxed">
                        Hệ thống đặt tour du lịch uy tín, mang đến trải nghiệm khám phá vẻ đẹp Việt Nam một cách trọn vẹn nhất.
                    </p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4 uppercase text-sm tracking-wider">Khám phá</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition-colors">Tour trong nước</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Tour nước ngoài</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Cẩm nang du lịch</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4 uppercase text-sm tracking-wider">Hỗ trợ</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition-colors">Chính sách bảo mật</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Điều khoản dịch vụ</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Liên hệ</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-teal-800 mt-12 pt-8 text-center text-sm text-teal-400">
                &copy; <?= date('Y') ?> VietTravel. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Initialize Lucide Icons -->
    <script>
        lucide.createIcons();
    </script>
</body>
</html>
