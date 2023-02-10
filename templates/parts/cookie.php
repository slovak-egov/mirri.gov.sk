<!-- COOKIES BANNER -->
<div class="idsk-cookie-banner pdt-20" data-nosnippet role="region" aria-label="<?php the_field('c_nadpis', 'options'); ?>" hidden>
  <!-- COOKIES MESSAGE -->
  <div class="idsk-cookie-banner__message govuk-width-container">
    <div class="govuk-grid-row">
      <div class="govuk-grid-column-two-thirds">
          <h2 class="idsk-cookie-banner__heading govuk-heading-m"><?php the_field('c_nadpis', 'options'); ?></h2>

        <div class="idsk-cookie-banner__content">
          <?php the_field('c_obsah', 'options'); ?>
        </div>
      </div>
    </div>

    <div class="idsk-button-group">
      <a class="govuk-link" href="<?php echo get_field('c_page', 'options')['url']; ?>" title="<?php _e('Nastavenia cookies', 'vicepremier'); ?>"><?php _e('Nastavenia cookies', 'vicepremier'); ?></a>

      <button type="button" class="idsk-button js-cookies-button-accept" data-module="idsk-button">
        <?php _e('Prijať všetky cookies', 'vicepremier'); ?>
      </button>

      <button type="button" class="idsk-button js-cookies-button-reject" data-module="idsk-button">
         <?php _e('Odmietnuť všetky cookies', 'vicepremier'); ?>
      </button>
    </div>
  </div>

  <!-- COOKIES ACCEPTED -->
  <div class="idsk-cookie-banner__message govuk-width-container js-cookie-banner-accepted app-width-container" role="alert" hidden>
    <div class="govuk-grid-row">
      <div class="govuk-grid-column-two-thirds">
        <div class="idsk-cookie-banner__content">
          <p>
         
            <?php _e('Prijali ste ukladanie analytických cookie súborov. Túto voľbu môžete kedykoľvek zmeniť v', 'vicepremier'); ?> <a class="govuk-link" href="<?php echo get_field('c_page', 'options')['url']; ?>" title="<?php _e('nastaveniach cookies', 'vicepremier'); ?>"><?php _e('nastaveniach cookies', 'vicepremier'); ?></a>.</p>
        </div>
      </div>
    </div>

    <div class="idsk-button-group">
      <button type="button" class="idsk-button js-cookies-button-accepted-hide" data-module="idsk-button">
        <?php _e('Skryť správu', 'vicepremier'); ?>
      </button>
    </div>
  </div>

  <!-- COOKIES REJECTED -->
  <div class="idsk-cookie-banner__message govuk-width-container js-cookie-banner-rejected app-width-container" role="alert" hidden>
    <div class="govuk-grid-row">
      <div class="govuk-grid-column-two-thirds">
        <div class="idsk-cookie-banner__content">
            <?php _e('Odmietli ste ukladanie analytických cookie súborov. Túto voľbu môžete kedykoľvek zmeniť v', 'vicepremier'); ?> <a class="govuk-link" href="<?php echo get_field('c_page', 'options')['url']; ?>" title="<?php _e('nastaveniach cookies', 'vicepremier'); ?>"><?php _e('nastaveniach cookies', 'vicepremier'); ?></a>.</p>
        </div>
      </div>
    </div>

    <div class="idsk-button-group">
      <button type="button" class="idsk-button js-cookies-button-rejected-hide" data-module="idsk-button">
        <?php _e('Skryť správu', 'vicepremier'); ?>
      </button>
    </div>
  </div>
</div>

<script>
  var cookieBanner = document.querySelector('.idsk-cookie-banner')
  var cookieBannerAccepted = document.querySelector('.js-cookie-banner-accepted')
  var cookieBannerRejected = document.querySelector('.js-cookie-banner-rejected')
  var cookieMessage = document.querySelector('.idsk-cookie-banner__message')
  var acceptButton = document.querySelector('.js-cookies-button-accept')
  var rejectButton = document.querySelector('.js-cookies-button-reject')
  var acceptedButtonHide = document.querySelector('.js-cookies-button-accepted-hide')
  var rejectedButtonHide = document.querySelector('.js-cookies-button-rejected-hide')

  if(cookieBanner){

    cookieBanner.hidden = (localStorage.getItem('acceptedCookieBanner') === 'true')

    acceptButton.addEventListener('click', function (event) {
      cookieMessage.hidden = true
      cookieBannerAccepted.hidden = false
      localStorage.setItem('googleAnalytics', 'true')
      localStorage.setItem('acceptedCookieBanner', 'true')
      event.preventDefault()
      const ev = new Event('cookieSettingsChanged');
      document.dispatchEvent(ev);
    })

    rejectButton.addEventListener('click', function (event) {
      cookieMessage.hidden = true
      cookieBannerRejected.hidden = false
      localStorage.setItem('googleAnalytics', 'false')
      localStorage.setItem('acceptedCookieBanner', 'true')
      event.preventDefault()
      const ev = new Event('cookieSettingsChanged');
      document.dispatchEvent(ev);
    })

    acceptedButtonHide.addEventListener('click', function (event) {
      cookieBanner.hidden = true
      event.preventDefault()
    })

    rejectedButtonHide.addEventListener('click', function (event) {
      cookieBanner.hidden = true
      event.preventDefault()
    })
  }
</script>
