<div class="wrap about-wrap eltdf-welcome-page">
    <div class="eltdf-welcome-page-heading">
        <div class="eltdf-welcome-page-logo">
            <img src="<?php echo esc_url( LAURENT_ELATED_FRAMEWORK_MODULES_ROOT . '/welcome/assets/img/logo.png' ); ?>" alt="<?php esc_attr_e( 'Qode Logo', 'laurent' ); ?>"/>
        </div>
        <h1 class="eltdf-welcome-page-title">
			<?php echo sprintf( esc_html__( 'Welcome to %s', 'laurent' ), $theme_name ); ?>
            <small><?php echo esc_html( $theme_version ) ?></small>
        </h1>
    </div>
    <div class="eltdf-welcome-page-text">
		<?php echo sprintf( esc_html__( 'Thank you for installing %s - %s! Everything in %s is streamlined to make your website building experience as simple and fun as possible. We hope you love using it to make a spectacular website.', 'laurent' ),
			$theme_name,
			$theme_description,
			$theme_name
		); ?>
    </div>
    <div class="eltdf-welcome-page-content">
        <div class="eltdf-welcome-page-screenshot">
            <img src="<?php echo esc_url( $theme_screenshot ); ?>" alt="<?php esc_attr_e( 'Theme Screenshot', 'laurent' ); ?>"/>
        </div>
        <div class="eltdf-welcome-page-links-holder">
            <div class="eltdf-welcome-page-install-core">
                <p><?php esc_html_e( 'Please install and activate required plugins in order to gain access to all the theme functionalities and features.', 'laurent' ); ?></p>
                <a class="eltdf-welcome-page-install-button" href="<?php echo add_query_arg( array( 'page' => 'install-required-plugins&plugin_status=install' ), esc_url( admin_url( 'themes.php' ) ) ); ?>">
					<?php esc_html_e( 'Install Required Plugins', 'laurent' ); ?>
                </a>
            </div>

            <h3><?php esc_html_e( 'Useful Links:', 'laurent' ); ?></h3>
            <ul class="eltdf-welcome-page-links">
                <li>
                    <a href="https://helpcenter.qodeinteractive.com" target="_blank"><?php esc_html_e( 'Help Center', 'laurent' ); ?></a>
                </li>
                <li>
	                <a href="https://laurent.qodeinteractive.com/documentation/" target="_blank"><?php esc_html_e( 'Theme Documentation', 'laurent' ); ?></a>
                </li>
                <li>
                    <a href="https://qodeinteractive.com/" target="_blank"><?php esc_html_e( 'All Our Themes', 'laurent' ); ?></a>
                </li>
                <li>
                    <a href="<?php echo add_query_arg( array( 'page' => 'install-required-plugins&plugin_status=install' ), esc_url( admin_url( 'themes.php' ) ) ); ?>"><?php esc_html_e( 'Install Required Plugins', 'laurent' ); ?></a>
                </li>
            </ul>
        </div>
    </div>
</div>