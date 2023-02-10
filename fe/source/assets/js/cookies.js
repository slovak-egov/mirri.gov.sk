function getAllCookies() {
    const cookiesString = document.cookie || '';
    const cookiesArray = cookiesString.split(';')
      .filter(cookie => cookie !== '')
      .map(cookie => cookie.trim());
  
    // Turn the cookie array into an object of key/value pairs
    const cookies = cookiesArray.reduce((acc, currentValue) => {
      const [key, value] = currentValue.split('=');
      const decodedValue = decodeURIComponent(value); // URI decoding
      acc[key] = decodedValue; // Assign the value to the object
      return acc;
    }, {});
  
    return cookies || {};
  }


  function createCookie(name, value, days, path, domain, secure) {
    // if number of days is given, sets expiry time
    let expires;
    if (days) {
      const date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
      expires = date.toUTCString();
    } else {
      expires = '';
    }
  
    // appends name to cookie, making it searchable
    let cookieString = `${name}=${escape(value)}`;
  
    if (expires) {
      cookieString += ';expires=' + expires;
    }
  
    if (path) {
      cookieString += ';path=' + escape(path);
    }
  
    // In the cookie spec, domains must have a '.' so e.g `localhost` is not valid
    // and should never be set as the domain.
    if (domain && domain.indexOf('.') !== -1) {
      cookieString += ';domain=' + escape(domain);
    }
  
    if (secure) {
      cookieString += ';secure';
    }
  
    cookieString += ';';
  
    // cookiestring now contains all necessary details and is turned into a cookie
    document.cookie = cookieString;
  }
  
  document.addEventListener("DOMContentLoaded", function(event) {
  
    //Init function
    var gaCheckbox = document.getElementById("ga-cookies");
    var preferencesCheckbox = document.getElementById("preferences-cookies");
  
    (function intCookies() {
      if(gaCheckbox) {
        gaCheckbox.checked = (window.localStorage.getItem('googleAnalytics') === 'true');
      }

      if(preferencesCheckbox) {
        preferencesCheckbox.checked = (window.localStorage.getItem('preferences') === 'true');
      }
    })();
  
    //Handle save cookie preferencies button
    var saveCookieButton = document.getElementsByClassName("save-cookie-settings")[0];
    if (saveCookieButton) {
      saveCookieButton.onclick = function () {
        window.localStorage.setItem('googleAnalytics', gaCheckbox.checked);
        window.localStorage.setItem('preferences', preferencesCheckbox.checked);
        const ev = new Event('cookieSettingsChanged');
  
        if (!gaCheckbox.checked) {
          const cookies = getAllCookies();
          const cookieNamesToDelete = Object.keys(cookies);
          cookieNamesToDelete.forEach((cookieName) => {
              if (cookieName.startsWith('_ga')) {
                createCookie(cookieName, '', -1, '/', '.gov.sk');
              }
          });
        }
  
        document.dispatchEvent(ev);
        location.reload();
      }
    }

    $('.js-cookies-button-accept').on('click', function(e) {
      initGtag()
    })
  });