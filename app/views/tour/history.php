<?php
// Handle active tab from URL, default to 'all'
$activeTab = isset($_GET['tab']) ? $_GET['tab'] : 'all';

// Filter bookings based on active tab
$filteredBookings = [];
if (!empty($data['bookings'])) {
    foreach ($data['bookings'] as $booking) {
        if ($activeTab === 'all') {
            $filteredBookings[] = $booking;
        } elseif ($activeTab === 'pending' && $booking->status == 0) {
            $filteredBookings[] = $booking;
        } elseif ($activeTab === 'approved' && $booking->status == 1) {
            $filteredBookings[] = $booking;
        } elseif ($activeTab === 'cancelled' && $booking->status == 2) {
            $filteredBookings[] = $booking;
        }
    }
}
?>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header -->
    <div class="mb-10 text-center">
        <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight mb-2">Lịch Sử Đặt Tour</h1>
        <p class="text-gray-500">Quản lý các chuyến đi của bạn</p>
    </div>

    <!-- Flash Messages -->
    <?php if (isset($data['error']) && $data['error']): ?>
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r-xl shadow-sm" role="alert">
            <p class="font-bold">Lỗi</p>
            <p><?= htmlentities($data['error']) ?></p>
        </div>
    <?php endif; ?>
    <?php if (isset($data['msg']) && $data['msg']): ?>
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-xl shadow-sm" role="alert">
            <p class="font-bold">Thành công</p>
            <p><?= htmlentities($data['msg']) ?></p>
        </div>
    <?php endif; ?>

    <!-- Tabs Navigation -->
    <div class="flex flex-wrap border-b border-gray-200 mb-8 gap-4 justify-center md:justify-start">
        <a href="?tab=all" class="px-6 py-3 font-semibold text-sm rounded-t-xl transition-all <?= $activeTab === 'all' ? 'border-b-2 border-teal-600 text-teal-600 bg-teal-50/50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' ?>">
            Tất cả
        </a>
        <a href="?tab=pending" class="px-6 py-3 font-semibold text-sm rounded-t-xl transition-all <?= $activeTab === 'pending' ? 'border-b-2 border-teal-600 text-teal-600 bg-teal-50/50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' ?>">
            Chờ xử lý
        </a>
        <a href="?tab=approved" class="px-6 py-3 font-semibold text-sm rounded-t-xl transition-all <?= $activeTab === 'approved' ? 'border-b-2 border-teal-600 text-teal-600 bg-teal-50/50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' ?>">
            Đã duyệt
        </a>
        <a href="?tab=cancelled" class="px-6 py-3 font-semibold text-sm rounded-t-xl transition-all <?= $activeTab === 'cancelled' ? 'border-b-2 border-teal-600 text-teal-600 bg-teal-50/50' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' ?>">
            Đã hủy
        </a>
    </div>

    <!-- Content -->
    <?php if (empty($filteredBookings)): ?>
        <div class="text-center py-20 bg-white rounded-3xl shadow-sm border border-gray-100">
            <div class="mx-auto w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mb-6">
                <i data-lucide="calendar" class="w-10 h-10 text-gray-300"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Chưa có chuyến đi nào</h3>
            <p class="text-gray-500 mb-8 max-w-sm mx-auto">Bạn chưa có đơn đặt tour nào trong mục này.</p>
            <a href="<?= BASE_URL ?>package" class="inline-block bg-teal-600 hover:bg-teal-700 text-white font-medium px-8 py-3 rounded-xl transition-all shadow-md shadow-teal-600/20">
                Khám phá ngay
            </a>
        </div>
    <?php else: ?>
        <div class="space-y-6">
            <?php foreach ($filteredBookings as $booking): ?>
                <?php
                    // Determine Status Badge
                    if ($booking->status == 1) {
                        $badgeHtml = '<span class="bg-emerald-100 text-emerald-800 px-3 py-1 rounded-full text-xs font-semibold flex items-center gap-1 shadow-sm w-fit"><i data-lucide="check-circle-2" class="w-3.5 h-3.5"></i> Đã Duyệt</span>';
                    } elseif ($booking->status == 2) {
                        $badgeHtml = '<span class="bg-rose-100 text-rose-800 px-3 py-1 rounded-full text-xs font-semibold flex items-center gap-1 shadow-sm w-fit"><i data-lucide="x-circle" class="w-3.5 h-3.5"></i> Đã Hủy (' . ($booking->cancelby == 'u' ? 'Bạn' : 'Admin') . ')</span>';
                    } else {
                        $badgeHtml = '<span class="bg-amber-100 text-amber-800 px-3 py-1 rounded-full text-xs font-semibold flex items-center gap-1 shadow-sm w-fit"><i data-lucide="clock" class="w-3.5 h-3.5"></i> Chờ Xử Lý</span>';
                    }
                ?>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden group hover:shadow-md transition-shadow">
                    <div class="p-6 md:p-8 flex flex-col md:flex-row gap-6 md:gap-8 items-start md:items-center">
                        <!-- Tour Image -->
                        <img src="<?= BASE_URL ?>admin/packageimages/<?= htmlentities($booking->packageimage ?? '') ?>" 
                             onerror="this.src='https://via.placeholder.com/400x300?text=No+Image'" 
                             alt="<?= htmlentities($booking->packagename) ?>" 
                             class="w-full md:w-48 h-32 object-cover rounded-xl shadow-inner flex-shrink-0" />
                        
                        <div class="flex-1 w-full">
                            <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4 mb-4">
                                <div>
                                    <div class="flex flex-wrap items-center gap-3 mb-2">
                                        <?= $badgeHtml ?>
                                        <span class="text-sm text-gray-500 font-medium">Mã Đơn: #BK<?= htmlentities($booking->bookid) ?></span>
                                    </div>
                                    <a href="<?= BASE_URL ?>package/details/<?= htmlentities($booking->pkgid) ?>" class="text-xl font-bold text-gray-900 leading-tight hover:text-teal-600 transition-colors">
                                        <?= htmlentities($booking->packagename) ?>
                                    </a>
                                </div>
                                <div class="text-left md:text-right flex-shrink-0">
                                    <p class="text-sm text-gray-500 uppercase tracking-widest font-semibold mb-1">Tổng cộng</p>
                                    <p class="text-2xl font-extrabold text-teal-600"><?= Controller::formatVND($booking->packageprice) ?></p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600 bg-gray-50 rounded-xl p-4">
                                <div class="flex items-center gap-2">
                                    <i data-lucide="calendar" class="w-4 h-4 text-teal-500"></i>
                                    <span class="font-medium text-gray-900">Khởi hành:</span>
                                    <?= htmlentities($booking->fromdate) ?>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i data-lucide="alert-circle" class="w-4 h-4 text-teal-500"></i>
                                    <span class="font-medium text-gray-900">Ngày đặt:</span>
                                    <?= htmlentities($booking->regdate) ?>
                                </div>
                                <?php if (!empty($booking->comment)): ?>
                                <div class="md:col-span-2 text-gray-500 italic mt-2 border-t border-gray-200 pt-3">
                                    <span class="font-medium not-italic text-gray-700">Ghi chú của bạn:</span> <?= htmlentities($booking->comment) ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Actions & Admin Notes -->
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
                        <?php if (!empty($booking->customermessage)): ?>
                            <div class="flex items-start gap-3 bg-amber-50 text-amber-800 p-4 rounded-xl flex-1 border border-amber-200 shadow-inner w-full">
                                <i data-lucide="message-circle" class="w-5 h-5 mt-0.5 flex-shrink-0"></i>
                                <div>
                                    <p class="font-bold text-sm mb-1">Tin nhắn từ GoTravel:</p>
                                    <p class="text-sm"><?= nl2br(htmlentities($booking->customermessage)) ?></p>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="flex-1"></div>
                        <?php endif; ?>

                        <!-- Cancel Button (Only if pending / status = 0) -->
                        <?php if ($booking->status == 0): ?>
                            <a href="<?= BASE_URL ?>tour/cancel/<?= htmlentities($booking->bookid) ?>" 
                               onclick="return confirm('Bạn có chắc chắn muốn hủy đơn đặt tour này?');"
                               class="w-full md:w-auto text-rose-600 hover:text-white border-2 border-rose-600 hover:bg-rose-600 font-bold px-6 py-2.5 rounded-xl transition-all shadow-sm flex items-center justify-center gap-2 whitespace-nowrap">
                                <i data-lucide="x-circle" class="w-4 h-4"></i>
                                Hủy Tour
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
