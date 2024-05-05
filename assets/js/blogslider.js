const course = document.querySelector(".blog-list");
const arrowBtns = document.querySelectorAll(".blog-list .item");
const firstItem = course.querySelector(".blog-item").offsetWidth + 30;
let autoScrollInterval;

// Hàm tự động cuộn
function startAutoScroll() {
    autoScrollInterval = setInterval(() => {
        // Kiểm tra xem không có nút điều khiển nào được nhấp mới tự động cuộn
        if (!document.querySelector('.feedback .dot.active')) {
            course.scrollLeft += firstItem; // Cuộn sang phải mỗi 2 giây
        }
    }, 500); // Thay đổi thời gian tự động cuộn thành 2 giây
}

// Dừng tự động cuộn
function stopAutoScroll() {
    clearInterval(autoScrollInterval);
}


// Bắt đầu tự động cuộn khi trang được tải
startAutoScroll();
