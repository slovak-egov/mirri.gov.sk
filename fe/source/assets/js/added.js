(function ($, root) {
    var maps = []
    var markersMap = []

    $('.youtube[data-href]').each(function(e) {
        var $youtubeBlock = $(this).parent()
        
        var $iframe = $('<iframe/>', {
            src: $(this).data('href'),
            allowfullscreen: ''
        })
        
        $youtubeBlock.html($iframe)
    })

    $('[data-fancybox="gallery"]').fancybox({
        loop : false,
        thumbs : {
            autoStart: true,
            hideOnClose: true, 
            parentEl: ".fancybox-container", 
            axis: "x"
        },
        buttons: [
            "zoom",
            // "share",
            // "slideShow",
            // "fullScreen",
            // "download",
            "thumbs",
            "close"
          ],
    })	

    $('.replaced-image').find('img').each(function(){
        var imgClass = (this.height < ($(this).parent().outerHeight())) ? 'wide' : 'tall';
        $(this).removeClass('wide').removeClass('tall').addClass(imgClass);
    })

    $('.small-nav .menu-item-has-children > a').click(function(){
        $(this).closest('li').toggleClass('active').children('ul').stop().slideToggle();
        

        if($(this).closest('li').hasClass('active')) {
            $(this).closest('li').find('> a[aria-expanded]').attr('aria-expanded', 'true')
        } else  {
            $(this).closest('li').find('> a[aria-expanded]').attr('aria-expanded', 'false')
        }

        return false;
        
    });

    $('.small-nav a[aria-expanded=true').closest('li').addClass('active')

    function uid() {
        let a = new Uint32Array(3);
        window.crypto.getRandomValues(a);
        return (performance.now().toString(36)+Array.from(a).map(A => A.toString(36)).join("")).replace(/\./g,"");
    }

    function printDataToForm($form, data) {
        var retHtml = ''

        var i = 0
        for(var d of data) {
            var id = uid()

            retHtml += `
                <tr class="idsk-table__row header-row" id="${id}${i}">
                    <td class="idsk-table__cell name-cell">
                        <strong>${d.meno}</strong><br/>
                        ${d.institucie.join(', ')}
                    </td>
                    <td class="idsk-table__cell">${d.popis}</td>
                    <td class="idsk-table__cell link-cell"><a href="${d.kurikulum.url}" target="_blank">${d.kurikulum.title?d.kurikulum.title:d.kurikulum.url}</a></td>
                    <td class="idsk-table__cell show-more-cell">
                        <div class="show-more">
                        </div>
                    </td>
                </tr>
                <tr class="idsk-table__row hidden-row additional-row" data-id="${id}${i++}">
                    <td class="idsk-table__cell" colspan="4">
                        <div class="cell-content">
                            <strong>Druh inštitúcie</strong>: ${d.druhy_institucie.join(', ')}<br/>
                            <strong>Mesto</strong>: ${d.mesta.join(', ')}<br/>
                            <strong>Oblasť expertízy</strong>: ${d.oblasti_exp.join(', ')}<br/>
                            <strong>Odbory expertízy</strong>: ${d.odbory_exp.join(', ')}<br/>
                            <strong>Aktivity sú aktuálne</strong>: ${d.aktualne}<br/>
                        </div>
                    </td>
                </tr>
            `
        }

        $form.find('.idsk-table__body').html(retHtml)
    }

    function clearSort($form, basic) {
        $form.find('.arrowBtn').removeClass('asc')
        $form.find('.arrowBtn').removeClass('desc')
        
        var message = $form.find('.arrowBtn').data('none')

        $form.find('.arrowBtn .sr-only').html(message)

        if(basic) {
            $($form.find('.arrowBtn')[0]).addClass('asc')
            $($form.find('.arrowBtn')[0]).find('.sr-only').html($($form.find('.arrowBtn')[0]).data['asc'])
        }
    }

    function sortBy(attribute, newVal, data) {
        var newData = data.sort(function(a, b) {
            if (newVal === 'desc') {
                tmp = a
                a = b
                b = tmp
            }

            switch(attribute) {
                case 'meno':
                case 'popis':
                case 'aktualne':
                    return a[attribute].localeCompare(b[attribute])
                case 'mesta':
                case 'institucie':
                case 'druhy_institucie':
                case 'druhy_instituciemesta':
                case 'oblasti_exp':
                case 'odbory_exp':
                    return a[attribute].join(',').localeCompare(b[attribute].join(','))
            }
        })

        return newData
    }

    $('.experts .arrowBtn').on('click', function(e) {
        var newVal = 'asc'

        if($(this).hasClass('asc')) {
            newVal = 'desc'
        }

        $form = $(this).closest('.experts')
        clearSort($form, false)

        $(this).addClass(newVal)
        $(this).find('.sr-only').html($(this).data(newVal))

        var expertsId = $form.data('id')
        var data = experts[expertsId]

        var attribute = $(this).data('col')

        data = sortBy(attribute, newVal, data)

        printDataToForm($form, data)
    })

    $(document).on('click', '.header-row .show-more', function(e) {
        var headerId = $(this).closest('.header-row').attr('id')

        var elementToHideShow = $('[data-id="' + headerId + '"]')

        if(elementToHideShow.hasClass('active')) {
            elementToHideShow.removeClass('active')
            $('#' + headerId).removeClass('active')
        } else {
            $('.additional-row, .header-row').removeClass('active')
            elementToHideShow.addClass('active')
            $('#' + headerId).addClass('active')
        }
    })

    $('.experts-form').on('submit', function() {
        $form = $(this).closest('.experts')

        var druh_institucie = $(this).find('*[name=druh_institucie]').val()
        var mesto = $(this).find('*[name=mesto]').val()
        var oblast_exp = $(this).find('*[name=oblast_expertizy]').val()
        var aktualne = $(this).find('*[name=aktualne]').val()

        var expertsId = $form.data('id')
        var data = experts[expertsId]

        clearSort($form, true)
        data = sortBy('meno', 'asc', data)

        data = data.filter(function(d) {
            if(druh_institucie !== '') {
                if(!d.druhy_institucie.includes(druh_institucie))
                    return false
            }

            if(mesto !== '') {
                if(!d.mesta.includes(mesto))
                    return false
            }

            if(oblast_exp !== '') {
                if(!d.oblasti_exp.includes(oblast_exp))
                    return false
            }

            if(aktualne !== '') {
                if(d.aktualne !== aktualne)
                    return false
            }

            return true
        })

        printDataToForm($form, data)
        showMarkers(data, maps[expertsId], markersMap[expertsId])
    })

    function showMarkers(data, map, markers) {
        if(!map || !markers) {
            return
        }

        markers.clearLayers()

        for(let d of data) {
            var marker = L.marker([d.pos.lat, d.pos.lng])

            var content = `
                <h4>${d.meno}</h4>
                <small>${d.mesta.join(', ')}</small>
                <p>
                    <b>Druh inštitúcie:</b> ${d.druhy_institucie.join(', ')}<br/>
                    <b>Názov inštitúcie: </b> ${d.institucie.join(', ')}<br/>
                    <b>Oblasť expertízy: </b> ${d.oblasti_exp.join(', ')}<br/>
                    <b>Odbory expertízy: </b> ${d.odbory_exp.join(', ')}<br/>
                    <b>Popis aktivít: </b> ${d.popis}<br/>
                    <b>Aktuálne aktivity: </b> ${d.aktualne}<br/>
                    <b>Kurikulum: </b> <a href="${d.kurikulum.url}" target="_blank">${d.kurikulum.url}</a><br/>
                </p>
            `

            function customTip() {
                this.unbindTooltip();
                if(!this.isPopupOpen()) this.bindTooltip(d.meno).openTooltip()
            }
            
            function customPop() {
                this.unbindTooltip()
            }

            marker.bindPopup(content)
            marker.on('mouseover', customTip)
            marker.on('click', customPop)

            markers.addLayer(marker)
        }

    }

    if($('.map-holder').length) {
        $('.map-holder').each(function(i,e) {
            var map = L.map('map').setView([48.706285, 19.613497], 7)

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map)

            var markers = L.markerClusterGroup()

            map.addLayer(markers)

            var $parent = $(e).closest('.experts')
            
            var idExperts = $parent.data('id')
            
            maps[idExperts] = map
            markersMap[idExperts] = markers

            var data = experts[idExperts]
            var data = experts[idExperts]

            showMarkers(data, map, markers)
        })
    }
})(jQuery, this);