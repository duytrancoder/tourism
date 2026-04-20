<div>
    <!-- Hero Section -->
    <section class="relative h-[80vh] min-h-[600px] flex items-center justify-center">
        <div class="absolute inset-0 z-0">
            <img src="<?= BASE_URL ?>public/img/nentour.jpg" onerror="this.src='https://images.unsplash.com/photo-1737484126640-7381808c768b?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxoYSUyMGxvbmclMjBiYXklMjB2aWV0bmFtfGVufDF8fHx8MTc3NTkxNTU3M3ww&ixlib=rb-4.1.0&q=80&w=1920'" alt="Hero Background" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-black/20 to-gray-50/90"></div>
        </div>

        <div class="relative z-10 w-full max-w-5xl mx-auto px-4 text-center mt-12">
            <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 drop-shadow-lg tracking-tight transition-all duration-700 opacity-0 translate-y-[-20px]" style="animation: fadeDown 0.8s forwards;">
                Khám Phá <span class="text-teal-400">Việt Nam</span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-100 mb-12 max-w-3xl mx-auto drop-shadow-md font-light transition-all duration-700 opacity-0" style="animation: fadeIn 0.8s 0.2s forwards;">
                Tìm kiếm những tour du lịch tuyệt vời nhất cho kỳ nghỉ của bạn.
            </p>

            <style>
                @keyframes fadeDown { to { opacity: 1; transform: translateY(0); } }
                @keyframes fadeIn { to { opacity: 1; } }
                @keyframes fadeUp { to { opacity: 1; transform: translateY(0); } }
            </style>

            <!-- Search Form - Hero -->
            <form action="<?= BASE_URL ?>package" method="GET" class="bg-white p-3 rounded-2xl shadow-2xl flex flex-col md:flex-row gap-2 max-w-4xl mx-auto backdrop-blur-lg bg-white/95 opacity-0 translate-y-[20px]" style="animation: fadeUp 0.8s 0.4s forwards;">
                <div class="flex-1 flex items-center bg-gray-50 rounded-xl px-4 py-3 hover:bg-gray-100 transition-colors">
                    <i data-lucide="search" class="text-gray-400 mr-3 w-5 h-5"></i>
                    <input type="text" name="keyword" placeholder="Từ khóa (ví dụ: Sapa, biển...)" class="w-full bg-transparent outline-none text-gray-800 placeholder-gray-400" />
                </div>
                <div class="w-px bg-gray-200 hidden md:block my-2"></div>
                <div class="flex-1 flex items-center bg-gray-50 rounded-xl px-4 py-3 hover:bg-gray-100 transition-colors">
                    <i data-lucide="map-pin" class="text-gray-400 mr-3 w-5 h-5"></i>
                    <select name="location" class="w-full bg-transparent outline-none text-gray-800 cursor-pointer">
                        <option value="">Tất cả địa điểm</option>
                        <?php foreach ($data['locations'] as $loc): ?>
                            <option value="<?= htmlentities($loc->PackageLocation) ?>"><?= htmlentities($loc->PackageLocation) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-semibold px-8 py-4 rounded-xl transition-colors shadow-md shadow-teal-600/20 whitespace-nowrap">
                    Tìm kiếm
                </button>
            </form>
        </div>
    </section>

    <!-- Featured Tours Section -->
    <section class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-sm font-bold tracking-widest text-teal-600 uppercase mb-2">Chuyến đi nổi bật</h2>
            <h3 class="text-4xl font-extrabold text-gray-900 tracking-tight">
                Tour Được Yêu Thích Nhất
            </h3>
            <div class="w-24 h-1 bg-teal-500 mx-auto mt-6 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php if (!empty($data['packages'])): ?>
                <?php foreach ($data['packages'] as $tour): ?>
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl border border-gray-100 flex flex-col group cursor-pointer transition-all duration-300 hover:-translate-y-1">
                        <div class="relative h-56 overflow-hidden">
                            <a href="<?= BASE_URL ?>package/details/<?= $tour->PackageId ?>">
                                <img src="<?= BASE_URL ?>admin/packageimages/<?= htmlentities($tour->PackageImage) ?>" alt="<?= htmlentities($tour->PackageName) ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-in-out" onerror="this.src='https://via.placeholder.com/400x300?text=No+Image'" />
                            </a>
                            <button onclick="toggleWishlist(<?= $tour->PackageId ?>, this, event)" class="absolute top-4 right-4 p-2 bg-white/80 backdrop-blur-sm rounded-full shadow-sm hover:scale-110 transition-transform z-10 btn-wishlist">
                                <i data-lucide="heart" class="w-5 h-5 text-gray-600 icon-heart"></i>
                            </button>
                            <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-md px-3 py-1 rounded-full text-xs font-semibold text-teal-800 shadow-sm flex items-center gap-1">
                                <i data-lucide="calendar" class="w-3.5 h-3.5"></i> <?= htmlentities($tour->TourDuration) ?>
                            </div>
                        </div>
                        
                        <div class="p-5 flex-1 flex flex-col">
                            <div class="flex items-center text-sm text-gray-500 mb-2 gap-1">
                                <i data-lucide="map-pin" class="w-4 h-4 text-teal-500"></i>
                                <?= htmlentities($tour->PackageLocation) ?>
                            </div>
                            <a href="<?= BASE_URL ?>package/details/<?= $tour->PackageId ?>" class="block">
                                <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-teal-600 transition-colors line-clamp-2">
                                    <?= htmlentities($tour->PackageName) ?>
                                </h3>
                            </a>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2 flex-1">
                                <?= htmlentities($tour->PackageFetures) ?>
                            </p>
                            <div class="mt-auto flex items-end justify-between border-t border-gray-100 pt-4">
                                <div>
                                    <span class="text-xs text-gray-500 uppercase tracking-wider block mb-1">Giá từ</span>
                                    <span class="text-2xl font-bold text-teal-600">
                                        <?= Controller::formatVND($tour->PackagePrice) ?>
                                    </span>
                                </div>
                                <a href="<?= BASE_URL ?>package/details/<?= $tour->PackageId ?>" class="bg-gray-900 text-white px-5 py-2.5 rounded-xl text-sm font-medium hover:bg-teal-600 transition-colors shadow-sm">
                                    Chi tiết
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-10 text-gray-500">
                    Chưa có tour nổi bật nào để hiển thị.
                </div>
            <?php endif; ?>
        </div>
        
        <div class="mt-16 text-center">
            <a href="<?= BASE_URL ?>package" class="inline-flex items-center justify-center px-8 py-3 border-2 border-teal-600 text-teal-700 font-semibold rounded-full hover:bg-teal-600 hover:text-white transition-all shadow-sm">
                Xem tất cả Tour
            </a>
        </div>
    </section>
</div>

<script>
    function toggleWishlist(packageId, buttonElement, event) {
        event.preventDefault();
        
        fetch('<?= BASE_URL ?>wishlist/toggle/' + packageId, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.requireLogin) {
                alert('Vui lòng đăng nhập để thêm vào danh sách yêu thích!');
                return;
            }
            
            if (data.success) {
                const icon = buttonElement.querySelector('.icon-heart');
                if (data.inWishlist) {
                    icon.classList.remove('text-gray-600');
                    icon.classList.add('fill-rose-500', 'text-rose-500');
                } else {
                    icon.classList.remove('fill-rose-500', 'text-rose-500');
                    icon.classList.add('text-gray-600');
                }
            } else {
                alert(data.message || 'Có lỗi xảy ra');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Lỗi kết nối mạng');
        });
    }

    // Check wishlist status on load for logged in users
    <?php if (isset($_SESSION['login']) && !empty($_SESSION['login'])): ?>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('<?= BASE_URL ?>wishlist/getIds', {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.packageIds && data.packageIds.length > 0) {
                const buttons = document.querySelectorAll('.btn-wishlist');
                buttons.forEach(btn => {
                    // Extract package ID from onclick attribute (e.g. toggleWishlist(7, this, event))
                    const onclickAttr = btn.getAttribute('onclick');
                    const match = onclickAttr.match(/toggleWishlist\((\d+)/);
                    if (match && match[1]) {
                        const pid = parseInt(match[1]);
                        if (data.packageIds.includes(pid)) {
                            const icon = btn.querySelector('.icon-heart');
                            icon.classList.remove('text-gray-600');
                            icon.classList.add('fill-rose-500', 'text-rose-500');
                        }
                    }
                });
            }
        });
    });
    <?php endif; ?>
</script>
