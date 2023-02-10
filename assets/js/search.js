/* global jQuery */
(function ($, root) {
    let jsonData = {}
    let tmpSearchFound = $($('#search-results-count').html())

    function findByParameters(search, urlVars) {        
        if(typeof search !== 'undefined') {
            search = search.replaceAll('+', ' ')
            
            $('input[name="search"]').val(search)
            
            var searchWithout = removeAccents(search)
            search = search.toLowerCase()
            searchWithout = searchWithout.toLowerCase()
            
            
            var count = 0
            var results = {}

            $.each(jsonData, function(name, value) {
                results[name] = loop(value, search, searchWithout, [], 0, null)  
            })
            
            var searchCategory = []
            var searchTimes = []
            var searchType = []
            var searchTag = []
            
            if(urlVars.length > 1) {
                $.each(urlVars, function(i,e) {
                    if(e == 'search') {
                        return true
                    } else {
                        $('input[name="' + e + '"]').prop('checked', true)
                    }
                    
                    $query = 'kategorie-'
                    
                    if(e.match("^" + $query)) {
                        var categoryId = e.replace($query, '') 
                       
                        if(urlVars[e] == 'on') {
                            searchCategory.push(categoryId)
                            return true 
                        }
                    }
                    
                    $query = 'tag-'
                    
                    if(e.match("^" + $query)) {
                        var categoryId = e.replace($query, '') 
                       
                        if(urlVars[e] == 'on') {
                            searchTag.push(categoryId)
                            return true
                        }
                    }
                    
                    if(e == 'today') {
                        if(urlVars[e] == 'on') {
                            var dateFrom = new Date()
                            dateFrom.setHours(0,0,0,0)
                            
                            searchTimes.push({
                                from: dateFrom,
                                to: new Date()
                            })
                            return true
                        }
                    }
                    
                    if(e == 'yesterday') {
                        if(urlVars[e] == 'on') {
                            var searchTimeFrom = new Date()
                            searchTimeFrom.setDate(searchTimeFrom.getDate() - 1)
                            
                            var searchTimeTo = new Date()
                            searchTimeTo.setHours(0,0,0,0)
                            
                            searchTimes.push({
                                from: searchTimeFrom,
                                to: searchTimeTo
                            })
                            return true
                        }
                    }
                    
                    if(e == 'last-month') {
                        if(urlVars[e] == 'on') {
                            var date = new Date()
                            var searchTimeFrom = new Date(date.getFullYear(), date.getMonth(), 1)
                            var searchTimeTo = new Date()
                            
                            searchTimes.push({
                                from: searchTimeFrom,
                                to: searchTimeTo
                            })
                            return true
                        }
                    }
                    
                    if(e == 'past-year') {
                        if(urlVars[e] == 'on') {
                            var searchTimeFrom = new Date('1990.1.1')
                            var searchTimeTo = new Date(new Date().getFullYear(), 0, 1)
                            
                            searchTimes.push({
                                from: searchTimeFrom,
                                to: searchTimeTo
                            })
                            return true
                        }
                    }
                    
                    if(e == 'last-year') {
                        if(urlVars[e] == 'on') {
                            var searchTimeFrom = new Date(new Date().getFullYear(), 0, 1)
                            var searchTimeTo = new Date()
                            
                            searchTimes.push({
                                from: searchTimeFrom,
                                to: searchTimeTo
                            })
                            return true
                        }
                    }
                    
                    if(urlVars[e] == 'on') {
                        searchType.push(e.replace('type-', ''))
                    }
                    
                })
            }
            
            
            //Search for all types
            if(searchType.length) {
                
                $.each(results, function(name, value) {
                    var newResultsPart = []
                    
                    $.each(value, function(id, result) {
                        if($.inArray(result.type, searchType) != -1) {
                            newResultsPart.push(result)
                        }
                    })
                    
                    results[name] = newResultsPart
                })
            }
            
            //Search for all category selected
            if(searchCategory.length) {
                $.each(results, function(name, value) {
                    var newResultsPart = []
                    
                    $.each(value, function(id, result) {
                        $.each(result.terms, function(i,e) {
                            if($.inArray(String(e.id), searchCategory) != -1) {
                                newResultsPart.push(result)
                                return true
                            }    
                        })
                        
                    })
                    
                    results[name] = newResultsPart
                })
            }
            
            //Search by tag
            if(searchTag.length) {
                $.each(results, function(name, value) {
                    var newResultsPart = []
                    
                    $.each(value, function(id, result) {
                        if(result.tags !== undefined) {
                            if(result.tags.length) {
                                $.each(result.tags, function(i,e) {
                                    if($.inArray(String(e), searchTag) != -1) {
                                        newResultsPart.push(result)
                                        return true
                                    }    
                                })
                            }
                        }
                    })
                    
                    results[name] = newResultsPart
                })
            }
            
            //Search by time
            if(searchTimes.length) {
                $.each(results, function(name, value) {
                    var newResultsPart = []
                    $.each(value, function(id, result) {
                        var insert = false
                        $.each(searchTimes, function(i,time) {
                            if(dateCheck(time.from, time.to, new Date(result.dateDefault))) {
                                insert = true
                            }
                        })
                        
                        if(insert) {
                            newResultsPart.push(result)
                        }
                    })
                    
                    results[name] = newResultsPart
                })
            }
            
            var i = 0
            var count = 0
            
            $.each(results, function(i,e) {
                count += e.length
            })
            
            $('#search-results-count').html('')
            $('#search-results-count').html(tmpSearchFound)
            $('#search-title').html('')
            $('#countSearch').html(count)
            
            $('#count1,#count2,#count3').addClass('hidden')
            
            if((count == 0) || (count > 4)) {
                $('#count3').removeClass('hidden')   
            } else if(count == 1) {
                $('#count1').removeClass('hidden')
            } else {
                $('#count2').removeClass('hidden')
            }
            
            if(count > 0) {
                $('#search-title').removeClass('hidden')
            }

            var sekcieTypes = []
            var clankyTypes = []

            //Select by categories
            $.each(results['sekcie'], function(name, value) {
                $.each(value.terms, function(a,term) {
                    if(typeof sekcieTypes[term.id] === 'undefined') {
                        sekcieTypes[term.id] = {
                            name: term.name,
                            url: term.url,
                            sekcie: []
                        }
                    }

                    sekcieTypes[term.id].sekcie.push(value)
                })  
            })

            $.each(results['clanky'], function(name, value) {
                $.each(value.terms, function(a,term) {
                    if(typeof clankyTypes[term.id] === 'undefined') {
                        clankyTypes[term.id] = {
                            name: term.name,
                            url: term.url,
                            clanky: []
                        }
                    }

                    clankyTypes[term.id].clanky.push(value)
                }) 
            })

            //Fill titles
            
            $.each(results, function(name, value) {
                if(value.length !== 0) {
                    var title = ''
                    if(value.length == 1) {
                        title = objectNames[name + '-single']    
                    } else if(value.length >= 5) {
                        title = objectNames[name + '-more']
                    } else {
                        title = objectNames[name]
                    }

                    if(name === 'sekcie') {
                        var retString = ''
                        $.each(sekcieTypes, function(i, e) {
                            if(typeof e !== 'undefined') {
                                retString += e.name + ' (' + e.sekcie.length + '), '
                            }
                        })

                        if(retString.length > 0) {
                            retString = retString.substr(0, retString.length-2)

                            title += ' - ' + retString
                        }
                    }

                    if(name === 'clanky') {
                        var retString = ''
                        $.each(clankyTypes, function(i,e) {
                            if(typeof e !== 'undefined') {
                                retString += e.name + ' (' + e.clanky.length + '), '
                            }
                        })

                        if(retString.length > 0) {
                            retString = retString.substr(0, retString.length-2)

                            title += ' - ' + retString
                        }
                    }
                    
                    $('#search-title').append($('<a/>', {href: "#" + i++ + "result", target: "_self", text: value.length + " " + title}))
                    $('#search-title').append(', ')
                }   
            })
            
            var item = $('#tempResult .result-list').html()
            let parentWrapper = $('#tempResult').html()

            var parEl = $(parentWrapper)
            
            parEl.find('.result').remove()
            parentWrapper = parEl[0].outerHTML


            $('#search-wrapper').html('')

            var i = 0
            
            
            $.each(results, function(name, value) {
                if(value.length) {
                    if((name !== 'clanky') && (name !== 'sekcie')) {

                        var title = ""
                        
                        if(value.length == 1) {
                            title = objectNames[name + '-single']    
                        } else if(value.length >= 5) {
                            title = objectNames[name + '-more']
                        } else {
                            title = objectNames[name]
                        }
                        
                        appendData(item, parentWrapper, item, searchCategory, title, value, value.length, i++)

                    } else {
                        var title = ""
                        
                        if(value.length == 1) {
                            title = objectNames[name + '-single']    
                        } else if(value.length >= 5) {
                            title = objectNames[name + '-more']
                        } else {
                            title = objectNames[name]
                        }

                        appendData(item, parentWrapper, item, searchCategory, title, [], value.length, i++)

                        if(name === 'sekcie') {
                            $.each(sekcieTypes, function(i,e) {
                                if(typeof e !== 'undefined') {                                    
                                    title = e.name
                                    appendData(item, parentWrapper, item, searchCategory, title, e.sekcie, e.sekcie.length, 'tmp')
                                }
                            })
                        } else {
                            $.each(clankyTypes, function(i,e) {
                                if(typeof e !== 'undefined') {
                                    title = e.name
                                    appendData(item, parentWrapper, item, searchCategory, title, e.clanky, e.clanky.length, 'tmp')
                                }
                            })
                        }
                    }
                }
            })
            
            $('#search-title a').on('click', function(e) { 
                e.preventDefault()
                $('html,body').animate({scrollTop:$(this.hash).offset().top-200}, 500)
			});
        }
        
        $('#search-page *').hide()
        $('#search-page *').not('.search-first').show()
    }

    function findByUrl() {
        var queryDict = {};
        
        location.search.substr(1).split("&").forEach(function(item) {queryDict[item.split("=")[0]] = item.split("=")[1]})

        var search = undefined
        
        if(typeof queryDict['search'] !== 'undefined') {
            search = decodeURIComponent(queryDict['search'])
        }

        var urlVars = getUrlVars()
        
        findByParameters(search, urlVars)
    }

    $.getJSON( "/wp-content/themes/vicepremier/search.json", function( data ) {
        jsonData = data
        
        findByUrl()
    })

    function buildSearch() {

        var values = $('#search-extend :input').serialize()
        var search = $($('.idsk-header-web__main-action-search')[0]).serialize()

        var urlEnd = search + '&' + values
        var url = $($('.idsk-header-web__main-action-search')[0]).attr('action')

        window.history.pushState('page2', window.document.title, url + '?' + urlEnd)

        findByUrl()
    }
    $('#search-extend input').on('change', function(e) {
        e.preventDefault()

        console.log('now')
        buildSearch()
    })

    // $('input[name="search"]').on('change', function() {
    //     console.log('wtf')
    //     buildSearch()
    // })
    
    function loop(data, search, searchWithout, result, deep, temp) {
        $.each(data, function(name, value) {
            if((typeof value === 'object')&&(value !== null)) {
                if(deep == 0) {
                    result = loop(value, search, searchWithout, result, 1, value)
                } else {
                    result = loop(value, search, searchWithout, result, 1, temp)
                }
            } else {
                if(typeof value == "string") {
                    var tmpValue = value.toLowerCase()
                    if (
                        (tmpValue.indexOf(search) >= 0) ||
                        (tmpValue.indexOf(searchWithout) >= 0)
                    ){
                        var insert = temp
                        if(temp == null) {
                            insert = value
                        }
                        
                        if($.inArray(insert, result) == -1) {
                            result.push(insert)
                        }
                    }
                }
            }
        });
        
        return result
    }

    function appendData(item, parentWrapper, item, searchCategory, title, value, valueLength, index) {
        selectBlock = parentWrapper
        selectBlock = selectBlock.replace('{{heading}}', valueLength + " " + title)
        selectBlock = selectBlock.replace('{{id-result}}', index + 'result')
        selectBlock = $(selectBlock)
        
        var $ul = selectBlock.find('.result-list')
        
        $.each(value, function(i, e) {
            var newItem = item
            
            newItem = newItem.replaceAll('{{date}}', e.date)
            
            // if(e.fields.nahladovy_obrazok_perex !== undefined) {
            //     newItem = newItem.replace('{{present-image}}', '<div class="-image cover" style="background: url(\'' + e.fields.nahladovy_obrazok_perex.value + '\')"></div>')
            // } else {
            //     newItem = newItem.replace('{{present-image}}', '<div class="-image cover" style="background: url(\'' + e.tmpImage + '\')"></div>')
            // }
            
            newItem = newItem.replaceAll('{{article-link}}', '<a href="' + e.url + '" target="_self">' + e.title + '</a>')
            
            if(e.terms.length > 0) {
                var term = e.terms[0]
                
                if(searchCategory.length) {
                    $.each(e.terms, function(a,b) {
                        if($.inArray(String(b), searchCategory)) {
                            term = b
                            return true
                        }
                    })    
                }
                newItem = newItem.replaceAll('{{category-link}}', '<a href="' + term.url + '" target="_self">' + term.name + '</a>')
            } else {
                newItem = newItem.replaceAll('{{category-link}}', '<a href="#" target="_self"></a>')
            }
            
            $ul.append(newItem)
        })
        
        $('#search-wrapper').append(selectBlock)
    }
    
    function getUrlVars() {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++) {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }
    
    function removeAccents(str) {
        var accents    = 'ÀÁÂÃÄÅàáâãäåßÒÓÔÕÕÖØòóôõöøĎďDŽdžÈÉÊËèéêëðÇçČčÐÌÍÎÏìíîïÙÚÛÜùúûüĽĹľĺÑŇňñŔŕŠšŤťŸÝÿýŽž';
        var accentsOut = "AAAAAAaaaaaasOOOOOOOooooooDdDZdzEEEEeeeeeCcCcDIIIIiiiiUUUUuuuuLLllNNnnRrSsTtYYyyZz";
        str = str.split('');
        var strLen = str.length;
        var i, x;
        for (i = 0; i < strLen; i++) {
            if ((x = accents.indexOf(str[i])) != -1) {
                str[i] = accentsOut[x];
            }
        }
        return str.join('');
    }
    
    function dateCheck(from,to,check) {
    
        var fDate,lDate,cDate;
        fDate = Date.parse(from);
        lDate = Date.parse(to);
        cDate = Date.parse(check);
        
        if((cDate <= lDate && cDate >= fDate)) {
            return true;
        }
        return false;
    }

})(jQuery, this);
