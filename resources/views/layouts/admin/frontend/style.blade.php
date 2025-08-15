 <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
               font-feature-settings: "cv03", "cv04", "cv11";
               font-family: var(--tblr-font-sans-serif);
               min-height: 100vh;
               display: flex;
               flex-direction: column;
        }

        /* Navbar adjustments for news style */
        .navbar-news {
            border-bottom: 3px solid #007bff;
        }

        .navbar-brand-news {
            font-size: 1.25rem;
            font-weight: 600;
            color: #007bff !important;
        }

        .navbar-nav .nav-link {
            font-weight: 600;
            color: #343a40 !important;
        }

        .navbar-nav .nav-link.active {
            color: #007bff !important;
        }

        /* Hero Section for Featured Article */
        .featured-article-hero {
            background-color: #343a40;
            /* Dark background */
            color: white;
            padding: 100px 0;
            text-align: left;
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
            background-size: cover;
            background-position: center;
        }

        .featured-article-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.4));
            z-index: 1;
        }

        .featured-article-hero .container {
            position: relative;
            z-index: 2;
        }

        .featured-article-hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .featured-article-hero p {
            font-size: 1.1rem;
            margin-bottom: 30px;
            max-width: 800px;
        }

        .featured-article-hero .btn {
            font-weight: 700;
            padding: 12px 30px;
        }

        /* Footer */
        .footer-news {
            background-color: #212529;
            /* Darker footer */
            color: rgba(255, 255, 255, 0.6);
            padding: 40px 0;
            font-size: 0.9rem;
        }

        .footer-news .link-secondary {
            color: rgba(255, 255, 255, 0.7) !important;
            text-decoration: none;
        }

        .footer-news .link-secondary:hover {
            color: white !important;
            text-decoration: underline;
        }

        /* Styling for social icons */
        .social-icons a {
            font-size: 2rem;
            color: #495057;
            /* Dark gray for icons */
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: #0d6efd;
            /* Bootstrap primary color on hover */
        }

        .note-editable ul {
            list-style-type: initial !important;
            padding-left: 20px !important;
        }

        .note-editable ol {
            list-style-type: decimal !important;
            padding-left: 20px !important;
        }
    </style>

    @stack('styles')