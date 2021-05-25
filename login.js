document.querySelector('.CApop').addEventListener('click', function(){
    document.querySelector('.CA').style.transform = 'scale(1)'
    document.querySelector('.LN').style.transform = 'scale(0)'
})

document.querySelector('.FPpop').addEventListener('click', function(){
    document.querySelector('.FP').style.transform = 'scale(1)'
    document.querySelector('.LN').style.transform = 'scale(0)'
})

document.querySelector('.LNpop').addEventListener('click', function(){
    document.querySelector('.FP').style.transform = 'scale(0)'
    document.querySelector('.LN').style.transform = 'scale(1)'
})

document.querySelector('.CALNpop').addEventListener('click', function(){
    document.querySelector('.CA').style.transform = 'scale(0)'
    document.querySelector('.LN').style.transform = 'scale(1)'
})