const blogList = document.querySelector(".blog-list");
const firstItem = blogList.querySelector(".item").offsetWidth + 30;
let autoScrollInterval;

// Hàm tự động cuộn
function startAutoScroll() {
    autoScrollInterval = setInterval(() => {
        // Lấy vị trí hiện tại của slide và tính toán slide tiếp theo
        const currentScrollLeft = blogList.scrollLeft;
        const nextScrollLeft = currentScrollLeft + firstItem;

        // Cuộn đến slide tiếp theo với hiệu ứng mượt mà
        blogList.scrollTo({
            left: nextScrollLeft,
            behavior: 'smooth'
        });

        // Kiểm tra xem slide hiện tại đã cuộn đến cuối danh sách chưa
        if (nextScrollLeft >= blogList.scrollWidth - blogList.clientWidth) {
            // Nếu đã cuộn đến cuối danh sách, quay lại slide đầu tiên
            blogList.scrollTo({
                left: 0,
                behavior: 'smooth'
            });
        }
    }, 3000); // Thời gian tự động cuộn là 3 giây
}

// Dừng tự động cuộn
function stopAutoScroll() {
    clearInterval(autoScrollInterval);
}

// Bắt đầu tự động cuộn khi trang được tải
startAutoScroll();
