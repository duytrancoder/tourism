<?php
$tour = $data['package'];
if (!$tour) {
    echo '<div class="p-20 text-center text-2xl font-bold">Tour không tồn tại</div>';
    return;
}
?>

<div class="bg-gray-50 min-h-screen pb-20">
    <!-- Messages -->
    <?php if (isset($data['error']) && $data['error']): ?>
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 mx-auto max-w-7xl mt-4" role="alert">
            <p class="font-bold">Lỗi</p>
            <p><?= htmlentities($data['error']) ?></p>
        </div>
    <?php endif; ?>
    <?php if (isset($data['msg']) && $data['msg']): ?>
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 mx-auto max-w-7xl mt-4" role="alert">
            <p class="font-bold">Thành công</p>
            <p><?= htmlentities($data['msg']) ?></p>
        </div>
    <?php endif; ?>

    <!-- Hero Header -->
    <div class="relative h-[60vh] w-full">
        <img src="<?= BASE_URL ?>admin/packageimages/<?= htmlentities($tour->PackageImage) ?>" onerror="this.src='https://via.placeholder.com/1920x1080?text=No+Image'" alt="<?= htmlentities($tour->PackageName) ?>" class="w-full h-full object-cover" />
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
        <div class="absolute bottom-0 left-0 w-full">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 pt-20">
                <div class="flex items-center text-teal-300 font-medium mb-4 gap-2 text-sm tracking-wider uppercase">
                    <i data-lucide="map-pin" class="w-4 h-4"></i>
                    <?= htmlentities($tour->PackageLocation) ?>
                </div>
                <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 drop-shadow-md tracking-tight">
                    <?= htmlentities($tour->PackageName) ?>
                </h1>
                <div class="flex items-center space-x-6 text-gray-200">
                    <span class="flex items-center gap-2 bg-white/10 px-4 py-2 rounded-full backdrop-blur-md border border-white/20">
                        <i data-lucide="clock" class="w-5 h-5"></i>
                        <span class="font-semibold"><?= htmlentities($tour->TourDuration) ?></span>
                    </span>
                    <span class="flex items-center gap-2 bg-white/10 px-4 py-2 rounded-full backdrop-blur-md border border-white/20">
                        <i data-lucide="info" class="w-5 h-5"></i>
                        <span class="font-semibold"><?= htmlentities($tour->PackageType) ?></span>
                    </span>
                    <!-- Wishlist button -->
                    <button onclick="toggleWishlist(<?= $tour->PackageId ?>, this, event)" class="flex items-center gap-2 bg-white/10 px-4 py-2 rounded-full backdrop-blur-md border border-white/20 hover:bg-white/20 transition-colors btn-wishlist">
                        <i data-lucide="heart" class="w-5 h-5 icon-heart text-white"></i>
                        <span class="font-semibold">Yêu thích</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-12">
                
                <!-- Overview Section -->
                <section class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <i data-lucide="info" class="text-teal-600"></i> Tổng quan
                    </h2>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Đặc trưng:</h3>
                    <p class="text-gray-600 leading-relaxed text-lg mb-6">
                        <?= htmlentities($tour->PackageFetures) ?>
                    </p>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Chi tiết:</h3>
                    <div class="text-gray-600 leading-relaxed">
                        <?= nl2br(htmlspecialchars($tour->PackageDetails, ENT_QUOTES, 'UTF-8')) ?>
                    </div>
                </section>

                <!-- Itinerary Section -->
                <?php if (isset($data['itineraries']) && count($data['itineraries']) > 0): ?>
                <section>
                    <h2 class="text-3xl font-bold text-gray-900 mb-8 tracking-tight">Lịch trình chi tiết</h2>
                    <div class="space-y-4">
                        <?php foreach ($data['itineraries'] as $index => $item): ?>
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden accordion-item">
                            <button type="button" class="accordion-button w-full flex items-center justify-between p-6 text-left focus:outline-none hover:bg-gray-50 transition-colors" onclick="toggleAccordion(this)">
                                <div class="flex items-center space-x-4">
                                    <div class="bg-teal-100 text-teal-800 w-12 h-12 rounded-xl flex items-center justify-center font-bold text-lg shadow-inner">
                                        <?= $index + 1 ?>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900"><?= htmlentities($item->TimeLabel) ?></h3>
                                </div>
                                <div class="text-gray-400 bg-gray-100 p-2 rounded-full icon-container">
                                    <i data-lucide="chevron-down" class="w-5 h-5 chevron-icon"></i>
                                </div>
                            </button>
                            <!-- Content panel -->
                            <div class="accordion-content hidden px-6 pb-6 pt-2 text-gray-600 border-t border-gray-50 leading-relaxed">
                                <p><?= nl2br(htmlspecialchars($item->Activity, ENT_QUOTES, 'UTF-8')) ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </section>
                <?php endif; ?>
            </div>

            <!-- Booking Sidebar -->
            <div class="lg:col-span-1">
                <div class="sticky top-24 bg-white rounded-3xl p-8 shadow-xl border border-gray-100">
                    <div class="text-center mb-8 border-b border-gray-100 pb-8">
                        <span class="text-sm text-gray-500 uppercase tracking-widest block mb-2 font-semibold">Giá tour / Khách</span>
                        <div class="text-4xl font-extrabold text-teal-600 tracking-tight">
                            <?= Controller::formatVND($tour->PackagePrice) ?>
                        </div>
                    </div>

                    <form name="book" method="post" action="<?= BASE_URL ?>package/book/<?= htmlentities($tour->PackageId) ?>" class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Ngày khởi hành</label>
                            <div class="relative">
                                <input type="date" name="departuredate" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none text-gray-700 font-medium" />
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Số người</label>
                            <div class="relative">
                                <input type="number" name="numberofpeople" min="1" max="100" value="1" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none text-gray-700 font-medium" />
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Ghi chú thêm (Tuỳ chọn)</label>
                            <textarea name="comment" rows="3" placeholder="Yêu cầu đặc biệt (ăn chay, dị ứng...)" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none resize-none text-gray-700"></textarea>
                        </div>

                        <ul class="space-y-3 mb-8 bg-gray-50 p-4 rounded-xl">
                            <li class="flex items-center text-sm text-gray-600">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-teal-500 mr-2 flex-shrink-0"></i> Đảm bảo giá tốt nhất
                            </li>
                            <li class="flex items-center text-sm text-gray-600">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-teal-500 mr-2 flex-shrink-0"></i> Miễn phí hủy trước 7 ngày
                            </li>
                            <li class="flex items-center text-sm text-gray-600">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-teal-500 mr-2 flex-shrink-0"></i> Hỗ trợ 24/7
                            </li>
                        </ul>

                        <?php if (!empty($_SESSION['login'])): ?>
                            <button type="submit" name="submit2" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-bold py-4 rounded-xl transition-all shadow-lg shadow-teal-600/30 text-lg flex items-center justify-center gap-2">
                                <i data-lucide="calendar" class="w-5 h-5"></i>
                                Đặt Tour Ngay
                            </button>
                        <?php else: ?>
                            <button type="button" onclick="alert('Vui lòng đăng nhập để đặt tour!'); window.location.href='<?= BASE_URL ?>'" class="w-full bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold py-4 rounded-xl transition-all text-lg flex items-center justify-center gap-2">
                                <i data-lucide="lock" class="w-5 h-5"></i>
                                Đăng nhập để đặt tour
                            </button>
                        <?php endif; ?>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    // Accordion Logic
    function toggleAccordion(button) {
        const content = button.nextElementSibling;
        const icon = button.querySelector('.chevron-icon');
        
        // Toggle hidden class
        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            icon.setAttribute('data-lucide', 'chevron-up');
        } else {
            content.classList.add('hidden');
            icon.setAttribute('data-lucide', 'chevron-down');
        }
        
        // Re-render icons since we changed the data-lucide attribute
        lucide.createIcons();
    }

    // Wishlist Logic
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
                    icon.classList.remove('text-white');
                    icon.classList.add('fill-rose-500', 'text-rose-500');
                } else {
                    icon.classList.remove('fill-rose-500', 'text-rose-500');
                    icon.classList.add('text-white');
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

    // Check wishlist status on load
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
                    const onclickAttr = btn.getAttribute('onclick');
                    const match = onclickAttr.match(/toggleWishlist\((\d+)/);
                    if (match && match[1]) {
                        const pid = parseInt(match[1]);
                        if (data.packageIds.includes(pid)) {
                            const icon = btn.querySelector('.icon-heart');
                            icon.classList.remove('text-white');
                            icon.classList.add('fill-rose-500', 'text-rose-500');
                        }
                    }
                });
            }
        });
    });
    <?php endif; ?>
</script>