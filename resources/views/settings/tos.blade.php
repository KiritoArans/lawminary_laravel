<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | Terms of Service</title>
        <link rel="icon" href="../../imgs/lawminarylogo_v3.png" type="image/png" />
        <link
            rel="stylesheet"
            href="{{ asset('css/settings/terms_of_service_style.css') }}"
        />
        <link rel="stylesheet" href="{{ asset('css/nav_style.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/responsive/navres.css') }}" />
        @include('inclusions/libraryLinks')
    </head>
    <body>
        <div class="container">
            @include('inclusions/userNav')
            <main>
                <header>
                    <div class="header-top">
                        <i class="fa-solid fa-bars"></i>
                        @include('includes_syscon.syscon_logo_inc')
                        <div class="notification">
                            <a href="../notifications" class="notification-link">
                                <i class="fas fa-bell bell-icon current"></i>
                                <span id="notification-count" class="notification-badge"></span>
                            </a>
                        </div>
                    </div>
                    <hr class="divider" />
                </header>
                <content class="tos-section">
                    <div class="tos-content">
                        <div id="tos-header">
                            <h2>Lawminary Terms of Service</h2>
                            <span><strong>Last Updated: 11/01/2024</strong></span>
                            <p>Welcome to Lawminary! By accessing and using our platform, you agree to abide by the following terms. Please read them carefully.</p>
                        </div>
                        
                        <h3>1. Purpose of Lawminary</h3>
                        <p>Lawminary is a web-based platform developed to enhance public understanding of the law by providing a comprehensive resource on legal matters. Our platform allows users to search for legal information, participate in discussions, and connect with legal professionals for educational purposes. Lawminary is not a substitute for professional legal advice.</p>
                        
                        <h3>2. User Responsibilities</h3>
                        <p>By using Lawminary, you agree to:</p>
                        <ul>
                            <li>Provide accurate and complete information during registration.</li>
                            <li>Maintain the security of your account, including your username and password.</li>
                            <li>Use the platform for lawful purposes, refraining from any behavior that is abusive, defamatory, or infringing on others' rights.</li>
                            <li>Respect the platform's guidelines regarding posting content, ensuring your contributions are relevant and constructive.</li>
                        </ul>
                        
                        <h3>3. Content and Intellectual Property</h3>
                        <p>Lawminary owns or has rights to all content provided on the platform, including articles, resources, and compiled laws. You may use this content for personal reference only. Any unauthorized distribution, reproduction, or modification is prohibited.</p>
                        <p>Users may post their own content (e.g., comments, questions, discussions). By doing so, you grant Lawminary a non-exclusive, worldwide license to use, distribute, and display your content within the platform.</p>
                        
                        <h3>4. Prohibited Uses</h3>
                        <p>Users may not:</p>
                        <ul>
                            <li>Use the platform to harass, threaten, or infringe on the rights of others.</li>
                            <li>Upload any harmful or malicious files, or disrupt the functioning of the platform.</li>
                            <li>Share confidential, private, or personally identifiable information without permission.</li>
                        </ul>
                        
                        <h3>5. Privacy Policy</h3>
                        <p>Your privacy is important to us. Please refer to our <a id="openAgreementModal">Data Privacy Agreement</a> for detailed information on how we collect, use, and protect your personal data.</p>
                        
                        <h3>6. Community Guidelines</h3>
                        <p>Lawminary encourages a supportive and informative environment. Users are expected to:</p>
                        <ul>
                            <li>Engage respectfully with others in discussions.</li>
                            <li>Provide constructive feedback, especially in testimonials and discussions.</li>
                            <li>Avoid making unsupported or defamatory claims about others.</li>
                        </ul>
                        
                        <h3>7. Lawyer User Responsibilities</h3>
                        <p>Lawyers using Lawminary to provide responses, insights, or general advice are expected to:</p>
                        <ul>
                            <li>Adhere to all legal and ethical standards.</li>
                            <li>Provide information responsibly and within their professional capacity.</li>
                            <li>Avoid giving specific legal advice that would constitute an attorney-client relationship on this platform.</li>
                        </ul>
                        
                        <h3>8. Moderator and Administrator Rights</h3>
                        <p>Lawminary moderators and administrators have the right to:</p>
                        <ul>
                            <li>Manage and edit user content to maintain platform standards.</li>
                            <li>Suspend or terminate accounts that violate these Terms of Service.</li>
                            <li>Provide reports on trends, FAQs, and user engagement, especially to support active users in the legal field.</li>
                        </ul>
                        
                        <h3>9. Limitation of Liability</h3>
                        <p>Lawminary is not liable for any indirect, incidental, or consequential damages arising from your use of the platform. The information provided is for educational purposes only and should not be considered legal advice.</p>
                        
                        <h3>10. Changes to the Terms of Service</h3>
                        <p>Lawminary reserves the right to update these Terms of Service at any time. We will notify users of significant changes. Continued use of the platform constitutes acceptance of the modified terms.</p>
                        
                        <h3>11. Contact Us</h3>
                        <p>For questions or concerns about these terms, please contact us at <a href="mailto:lawminary@gmail.com">lawminary@gmail.com</a>.</p>
                    </div>
                    @include('inclusions/agreementModal')
                </content>
            </main>
        </div>
        <script>
            var agreementModal = document.getElementById("agreementModal");
            var span = document.getElementById("closeAgreementModal");

            document.getElementById("openAgreementModal").onclick = function(event) {
                event.preventDefault(); // Prevent default anchor behavior
                agreementModal.style.display = "flex"; // Show the modal
            }

            span.onclick = function() {
                agreementModal.style.display = "none"; // Hide the modal
            }
            window.onclick = function(event) {
                if (event.target == agreementModal) {
                    agreementModal.style.display = "none"; // Hide the modal
                }
            }
        </script>
        <script src="../js/showUserNav.js"></script>
        <script src="../js/showNotification.js"></script>
        <script src="../js/settings.js"></script>
        <script src="../js/logout.js"></script>
    </body>
</html>
