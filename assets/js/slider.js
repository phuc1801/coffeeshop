const course = document.querySelector(".course-list");
const arrowBtns = document.querySelectorAll(".popular .control-btn");
const firstItem = course.querySelector(".course-item").offsetWidth + 30;
let autoScrollInterval;

// Hàm tự động cuộn
function startAutoScroll() {
    autoScrollInterval = setInterval(() => {
        // Kiểm tra xem không có nút điều khiển nào được nhấp mới tự động cuộn
        if (!document.querySelector('.popular .control-btn.active')) {
            course.scrollLeft += firstItem; // Cuộn sang phải mỗi 2 giây
        }
    }, 3000); // Thay đổi thời gian tự động cuộn thành 2 giây
}

// Dừng tự động cuộn
function stopAutoScroll() {
    clearInterval(autoScrollInterval);
}

// Thêm sự kiện click cho nút điều khiển
arrowBtns.forEach(btn => {
    btn.addEventListener("click", () => {
        // Dừng tự động cuộn khi người dùng click vào nút điều khiển
        stopAutoScroll();
        // Sau đó cuộn theo hướng tương ứng với nút
        course.scrollLeft += btn.id === "left" ? -firstItem : firstItem;
    });
});

// Bắt đầu tự động cuộn khi trang được tải
startAutoScroll();
