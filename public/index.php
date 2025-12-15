<?php
// Lấy dữ liệu dự án từ API PHP
$projects = [];
try {
    $json = @file_get_contents(__DIR__.'/api/projects.php');
    if ($json) $projects = json_decode($json, true);
} catch (Exception $e) {}
// Xử lý gửi liên hệ
$contactResult = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['email'], $_POST['message'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);
    if ($name && filter_var($email, FILTER_VALIDATE_EMAIL) && $message) {
        $contactResult = '<span style="color:green;">Gửi thành công!</span>';
        // Có thể lưu vào DB hoặc gửi email ở đây
    } else {
        $contactResult = '<span style="color:red;">Vui lòng nhập đầy đủ thông tin hợp lệ.</span>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio SPA</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
</head>
<body>
    <div id="particles-js" style="position:fixed;z-index:0;top:0;left:0;width:100vw;height:100vh;"></div>
    <div id="app" class="golden-layout" style="position:relative;z-index:1;">
        <aside class="golden-aside">
            <header>
                <h1 style="margin-bottom:0;">Nguyễn Hữu Chương</h1>
                <p id="typed-desc" style="margin-top:8px; color:#888; font-size:1.1em;min-height:32px;">Fullstack Web Developer | UI/UX Enthusiast</p>
                <div class="socials">
                    <a href="https://facebook.com" target="_blank" title="Facebook"><i class="fab fa-facebook"></i></a>
                    <a href="https://github.com" target="_blank" title="GitHub"><i class="fab fa-github"></i></a>
                    <a href="https://linkedin.com" target="_blank" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                </div>
            </header>
            <nav>
                <a href="#about" class="nav-link">Giới thiệu</a>
                <a href="#timeline" class="nav-link">Kinh nghiệm</a>
                <a href="#projects" class="nav-link">Dự án</a>
                <a href="#contact" class="nav-link">Liên hệ</a>
            </nav>
            <section id="about" data-aos="fade-right">
                <h2>Giới thiệu</h2>
                <p>Tôi là lập trình viên web với hơn 3 năm kinh nghiệm phát triển ứng dụng web hiện đại, tối ưu trải nghiệm người dùng và hiệu suất. Đam mê UI/UX, thích sáng tạo và học hỏi công nghệ mới.</p>
            </section>
            <section id="timeline" data-aos="fade-up">
                <h2>Kinh nghiệm & Học vấn</h2>
                <div class="timeline">
                    <div class="timeline-item">
                        <b>2023 - Nay:</b> Web Developer tại <span style="color:#fda085">ABC Company</span><br>
                        <span style="color:#888;">Phát triển hệ thống quản lý, tối ưu giao diện, xây dựng API.</span>
                    </div>
                    <div class="timeline-item">
                        <b>2021 - 2023:</b> Freelancer Web & App<br>
                        <span style="color:#888;">Thiết kế landing page, portfolio, blog cá nhân cho khách hàng.</span>
                    </div>
                    <div class="timeline-item">
                        <b>2018 - 2021:</b> Đại học CNTT<br>
                        <span style="color:#888;">Chuyên ngành Kỹ thuật phần mềm.</span>
                    </div>
                </div>
            </section>
        </aside>
        <main class="golden-main">
            <section id="projects" data-aos="fade-left">
                <h2>Dự án nổi bật</h2>
                <div id="project-list">
                    <?php if (empty($projects)): ?>
                        <em>Chưa có dự án nào.</em>
                    <?php else: ?>
                        <?php foreach ($projects as $p): ?>
                            <div class="project-card" data-aos="zoom-in-up">
                                <div class="project-title"><?=htmlspecialchars($p['title'])?></div>
                                <div class="project-desc"><?=htmlspecialchars($p['desc'])?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </section>
            <section id="contact" data-aos="fade-up">
                <h2>Liên hệ</h2>
                <form id="contact-form" method="post" autocomplete="off">
                    <input type="text" name="name" placeholder="Tên của bạn" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <textarea name="message" placeholder="Nội dung" required></textarea>
                    <button type="submit">Gửi</button>
                </form>
                <div id="contact-result"><?=$contactResult?></div>
            </section>
        </main>
    </div>
</body>
<!-- JS LIBS: particles.js, aos, typed.js -->
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
<script>
// particles.js config
particlesJS.load('particles-js', 'https://cdn.jsdelivr.net/gh/VincentGarreau/particles.js/demo/particles.json', function(){});
// AOS
AOS.init({ once: true, duration: 900, offset: 60 });
// Smooth scroll cho nav-link
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if(target) target.scrollIntoView({behavior:'smooth'});
        });
    });
    // Typed.js hiệu ứng typing cho mô tả
    if(window.Typed) {
        new Typed('#typed-desc', {
            strings: [
                'Fullstack Web Developer',
                'UI/UX Enthusiast',
                'Yêu thích sáng tạo & công nghệ',
                'Nguyễn Hữu Chương - Portfolio'
            ],
            typeSpeed: 45,
            backSpeed: 28,
            backDelay: 1200,
            loop: true,
            showCursor: true
        });
    }
});
</script>
</html>