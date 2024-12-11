<style>
    /* primary btn css */
    .my-btn-primary-color {
        background-color: <?= BG_COLOR;
                            ?> !important;
        color: <?= TEXT_COLOR;
                ?> !important;
        border-color: <?= BG_COLOR;
                        ?> !important;
    }

    /* required fields css */
    .required {
        color: #f9c934;
    }


    /* links css */

    a {
        color: <?= TEXT_COLOR;
                ?>;

    }

    .nav-pills .nav-link:not(.active):hover {
        color: #000;
    }


    .page-item.active .page-link {
        color: <?= TEXT_COLOR;
                ?> !important;
        background-color: <?= BG_COLOR;
                            ?> !important;
        border-color: <?= BG_COLOR;
                        ?> !important;
    }

    a:hover {
        color: #000;
        text-decoration: none;
    }

    /* Sidebar Tab Sidebar css */

    .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active,
    .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
        background-color: <?= BG_COLOR;
                            ?> !important;
        color: <?= TEXT_COLOR;
                ?> !important;
    }

    /* nav tab css */
    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        background-color: <?= BG_COLOR;
                            ?> !important;
        color: <?= TEXT_COLOR;
                ?> !important;


    }

    .nav-pills .nav-link {
        border-radius: <?= CARD_SHAPE;
                        ?> !important;
    }

    /*  card-body css */
    .curve-card {
        border-radius: <?= CARD_SHAPE;
                        ?> !important;

    }



    /*  Based BG-color css */
    .base-bg-color {
        background-color: <?= BG_COLOR;
                            ?> !important;
    }

    /*  Based text-color css */

    .base-text-color {
        color: <?= TEXT_COLOR;
                ?> !important;
    }

    /* Proile card css */
    .card-primary.card-outline {
        border-top: 3px solid<?= BG_COLOR;
                                ?> !important;
    }

    /* Multiple select options css */

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: <?= BG_COLOR;
                            ?> !important;
        border-color: <?= BG_COLOR;
                        ?> !important;
        color: <?= TEXT_COLOR;
                ?> !important;
        padding: 0 10px;
        margin-top: 0.31rem;
    }

    /* login css */

    .login-box,
    .register-box {
        width: 100% !important;
    }

    @media (max-width: 576px) {

        .login-box,
        .register-box {
            margin-top: 0;
            width: 100% !important;
        }
    }
</style>