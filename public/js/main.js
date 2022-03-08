window.onload = () => {
    checkRange('#training-time')
    checkRange('#edit-time')

    setTimeout(() => {$('.chart').css({'height': $('.chart').outerWidth() + 'px'}) }, 200)
}

window.onresize = () => {
    $('.chart').css({'height': $('.chart').outerWidth() + 'px'})
}

$('ul:first-of-type li span').on('click', (ev) => {
    $('ul:first-of-type li span img').css('opacity', 0.5)
    $(ev.target).css('opacity', 1)
    order(($(ev.target).attr('class') === 'u') ? true: false, $(ev.target).attr('data-do'))
    console.log(ev.target)
})

$('#training-time').on('input', () => {
    checkRange('#training-time')
})

$('#edit-time').on('input', () => {
    checkRange('#edit-time')
})

$('form div label').on('click', (ev) => {
    if ($(ev.target).attr('class') === undefined) {
        $('form .container:first-of-type label').removeClass('selected')
        $(ev.target).addClass('selected')
    } else if ($(ev.target).attr('class') === 'check selected') {
        $(ev.target).removeClass('selected')
    } else {
        $(ev.target).addClass('selected')
    }

    
    if ($(ev.target).parent().parent().attr('id') === 'add-form')
        setTimeout(() => {checkForm()}, 100)
    else
    setTimeout(() => {checkEdit()}, 100)
})

$('#training-type').on('keyup', () => {
    if (checkInput($('#training-type'), '^[A-Za-z0-9äöüÄÖÜ ]*$', 64))
        $('#add-button').attr('disabled', true)
    else 
        $('#add-button').attr('disabled', false)
    checkForm()
})


$('#edit-type').on('keyup', () => {
    if (checkInput($('#edit-type'), '^[A-Za-z0-9äöüÄÖÜ ]*$', 64))
        $('#edit-button').attr('disabled', true)
    else 
        $('#edit-button').attr('disabled', false)
    checkEdit()
})


$('#training-note').on('keyup', () => {
    checkInput($('#training-note'), '', 255)
})

$('#edit-note').on('keyup', () => {
    checkInput($('#edit-note'), '', 255)
})

$('#add-new').on('click', () => {
    openBox('#add-box')

})

$('.edit-button').on('click', (ev) => {
    let id = $('#'+$(ev.target).parent().parent().parent().attr('id'))
    openBox('#editing-box')
    $('#edit-type').val(id.find('.type').text().trim())
    checkInput($('#edit-type'), '^[A-Za-z0-9äöüÄÖÜ ]*$', 64)
    $('#edit-note').val(id.find('.notes').text().trim())
    checkInput($('#edit-note'), '', 255)
    $('label[for="edit-'+id.find('.category').text().trim()+'"]').trigger('click')
    $('#edit-time').val(id.find('.time').text().trim().slice(0,-1))
    checkRange('#edit-time')

    id.find('.tags').children().each((index) => {
        let tagId = id.find('.tags').find('span')[index].dataset.id.split('-').pop()
        $('label[for="edit-tag-'+tagId+'"]').trigger('click')
    })
    $('#edit-id').val($(ev.target).parent().parent().parent().attr('id'))
})

$('#add-form').on('submit', (ev) => {
    ev.preventDefault()

    if (checkForm())
        $.ajax({
            method: 'POST',
            url: 'check-entry',
            data: $('#add-form').serialize(),
            success: (data) => {
                if (parseInt(data) === 1) {
                    closeBox('#add-box')
                    setTimeout(() => {location.reload()}, 300) // HAHAHAHAHAH
                } else {
                    $('#add-button').attr('disabled', true)
                    $('#add-form .main-error').addClass('show')
                }
            }, error: () => {
                $('#add-button').attr('disabled', true)
                $('#add-form .main-error').addClass('show')
            }
        })
})

$('#editing-form').on('submit', (ev) => {
    ev.preventDefault()

    if (checkEdit())
        $.ajax({
            method: 'POST',
            url: 'edit-entry',
            data: $('#editing-form').serialize(),
            success: (data) => {
                if (parseInt(data) === 1) {
                    closeBox('#editing-box')
                    setTimeout(() => {location.reload()}, 300) // HAHAHAHAHAH
                } else {
                    $('#edit-button').attr('disabled', true)
                    $('#editing-form .main-error').addClass('show')
                }
            }, error: (data) => {
                $('#edit-button').attr('disabled', true)
                $('#editing-form .main-error').addClass('show')
            }
        })
})

$('.close').on('click', (ev) => {
    closeBox($(ev.target).attr('data-id'))
})

function checkForm() {
    let send = true
    if ($('#training-type').val().length < 2)
        send = false
    else if (checkInput($('#training-type'), '^[A-Za-z0-9äöüÄÖÜ ]*$', 64))
        send = false

    if ($("#add-form input[type='radio']:checked").val() === undefined)
        send = false

    if (!send) {
        $('#add-button').attr('disabled', true)
        $('#add-form .main-error').addClass('show')
    } else {
        $('#add-button').attr('disabled', false)
        $('#add-form .main-error').removeClass('show')
    }

    return send
}

function checkEdit() {
    let send = true
    if ($('#edit-type').val().length < 2)
        send = false
    else if (checkInput($('#edit-type'), '^[A-Za-z0-9äöüÄÖÜ ]*$', 64))
        send = false

    if ($("#editing-form input[type='radio']:checked").val() === undefined)
        send = false

    if (!send) {
        $('#edit-button').attr('disabled', true)
        $('#editing-form .main-error').addClass('show')
    } else {
        $('#edit-button').attr('disabled', false)
        $('#editing-form .main-error').removeClass('show')
    }

    return send
}

function openBox(box) {
    $(box).parent().addClass('open-box')
    setTimeout(() => {
        $(box).parent().addClass('open-box-opacity')
        setTimeout(() => {
            $(box).addClass('open-box-come')
            $(box).find('.general-input').first().focus()
        }, 50)
    }, 50)
}

function closeBox(box) {
    $(box).removeClass('open-box-come')
    setTimeout(() => {
        $(box).parent().removeClass('open-box-opacity')
        setTimeout(() => {
            $(box).parent().removeClass('open-box')
            $(box).find('.general-input').val('')
            $(box).find('input[type="range"]').val('2')
            checkRange('#training-time')
            $(box).find('input[type="radio"]').prop('checked', false)
            $('form div label').removeClass('selected')
        }, 200)
    }, 50)
}

function checkInput(input, regex, max) {
    if (input.val().length > max)
        input.val(input.val().substring(0, max))

    let disabled = false
    if (!new RegExp(regex).test(input.val())) {
        $('.validation[for=' +input.attr('id')+ ']').addClass('error')
        disabled = true
    } else {
        $('.validation[for=' +input.attr('id')+ ']').removeClass('error')
        disabled = false
    }
    
    
    $('.word-counter[for=' +input.attr('id')+ ']').text(input.val().length + ' / ' + max)

    return disabled
}

function checkRange(id) {
    $('.your-range[for="' +id+ '"]').text($(id).val() + 'h')
}

function order(up, cls) {
    var theContainer = $("#order"), // You could use body if all the rows are children of body
    theRows = $("#order ul").get() // an array

    if (up) {
        theRows = theRows.sort(function (a, b) {
            var aKBPS = $("." + cls, a).text(),
                bKBPS = $("." + cls, b).text()
                return aKBPS > bKBPS ? -1 : aKBPS > bKBPS ? 1 : 0
        })
        theContainer.append(theRows)
    } else {
        theRows = theRows.sort(function (a, b) {
            var aKBPS = $("." + cls, a).text(),
                bKBPS = $("." + cls, b).text()
                return aKBPS < bKBPS ? -1 : aKBPS < bKBPS ? 1 : 0
        })
        theContainer.append(theRows)
    }

}