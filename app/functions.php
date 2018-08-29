<?php

function subjectArray (){
   return ['english', 'mathematics', 'commerce', 'account', 'biology', 'physics', 'chemistry', 'englishlit', 'government', 'crk', 'geography', 'economics', 'irk', 'civiledu', 'insurance', 'currentaffairs', 'history'];
}

function examTypeArray(){
    return ['waec', 'jamb', 'neco', 'post-utme'];
}

function querySampleArray1(){
    return ['https://questions.aloc.ng/api/q?subject=english',
        'https://questions.aloc.ng/api/q?subject=english&year=2010',
        'https://questions.aloc.ng/api/q?subject=insurance&type=wassce',
        'https://questions.aloc.ng/api/q?subject=english&year=2009&type=utme'];
}

function querySampleArray2(){
    return ['https://questions.aloc.ng/api/q/0?subject=english',
        'https://questions.aloc.ng/api/q/1?subject=english&year=2010',
        'https://questions.aloc.ng/api/q/2?subject=insurance&type=wassce',
        'https://questions.aloc.ng/api/q/3?subject=english&year=2009&type=utme'];
}

