window.onload = () => {
    openBox('#add-box')
}

$('#training-type').on('keyup', () => {
    checkInput($('#training-type'), '^[A-Za-z0-9äöüÄÖÜ ]*$', 64)
})

$('#training-note').on('keyup', () => {
    checkInput($('#training-note'), '', 255)
})

$('#add-new').on('click', () => {
    openBox('#add-box')
})

$('.close').on('click', (ev) => {
    closeBox($(ev.target).attr('data-id'))
})

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
    let button = input.parent().find('button')
    if (disabled)
        button.attr('disabled', true)
    else
        button.attr('disabled', false)
    
    
    $('.word-counter[for=' +input.attr('id')+ ']').text(input.val().length + ' / ' + max)

    return disabled
}