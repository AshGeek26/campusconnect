<?php
// index.php - Homepage
include '../includes/header.php';
?>

<main>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <h1>Campus Connect: Your Community, Your Voice</h1>
            <p>Stay informed, share your story, and connect with your entire campus community in one seamless platform.</p>
            <a href="signup.php" class="cta-button">Get Started</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
            <h2>Why Campus Connect?</h2>
            <div class="features-grid">
                <div class="feature-item">
                    <i class="fas fa-bullhorn"></i>
                    <h3>Real-Time Updates</h3>
                    <p>Get instant news and announcements from across campus.</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-users"></i>
                    <h3>Community Engagement</h3>
                    <p>Share stories, concerns, and connect with fellow students.</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-comment-dots"></i>
                    <h3>Easy Feedback</h3>
                    <p>Submit suggestions and feedback directly to campus leadership.</p>
                </div>
            </div>
    </section>
</main>

<?php
include '../includes/footer.php';
?>
