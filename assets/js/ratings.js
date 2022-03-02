jQuery(document).ready(function( $ ) {
    // text descriptions for different rating numbers
    const ratingDescriptors = {
        1: 'Excellent', // > 8
        2: 'Great', // 6-8
        3: 'Good', // 4-6
        4: 'Average', // 2-4
        5: 'Mediocre' // <2
    };

    // get the width value based off the element id
    const getWidthVal = (elId) => {
        return $(elId + ' .hidden-rating-progress-number').text() * 10;
    }

    // set the width for the progress bar
    const setRatingProgressBar =  (elId, widthVal) => {
        $(elId + ' .single-adventure-rating-progress').css('width', widthVal + '%');
    }

    // set the descriptive text for the rating
    const setRatingDescriptiveText = (elId, descriptors, widthVal) => {
        let descriptiveText;

        switch(true) {
            case (widthVal <= 20):
                descriptiveText = descriptors[5];
                break;
            case (widthVal <= 40):
                descriptiveText = descriptors[4];
                break;
            case (widthVal <= 60):
                descriptiveText = descriptors[3];
                break;
            case (widthVal <= 80):
                descriptiveText = descriptors[2];
                break;
            case (widthVal > 80):
                descriptiveText = descriptors[1];
                break;
            default:
                descriptiveText = 'All trails are great trails ;-)';
        }

        $(elId + ' .rating-descriptive-text p').text(descriptiveText);
    }

    // change the color of the rating bar based off the rating value
    const changeRatingBarColor = (elId, widthVal) => {
        const red = '#eb0505';
        const orange = '#eb8005';
        const yellow = '#ebe305';
        const green = '#05eb18';
        const blue = '#0555eb';

        switch(true) {
            case (widthVal <= 20):
                $(elId + ' .single-adventure-rating-progress').css('background-color', red);
                break;
            case (widthVal <= 40):
                $(elId + ' .single-adventure-rating-progress').css('background-color', orange);
                break;
            case (widthVal <= 60):
                $(elId + ' .single-adventure-rating-progress').css('background-color', yellow);
                break;
            case (widthVal <= 80):
                $(elId + ' .single-adventure-rating-progress').css('background-color', green);
                break;
            case (widthVal > 80):
                $(elId + ' .single-adventure-rating-progress').css('background-color', blue);
                break;
            default:
                $(elId + ' .single-adventure-rating-progress').css('background-color', blue);
        }
    }

    // put the entire rating together
    const buildRating = (elId, descriptors, widthVal) => {
        setRatingProgressBar(elId, widthVal);
        changeRatingBarColor(elId, widthVal);
        setRatingDescriptiveText(elId, descriptors, widthVal);
    }

    // set rating for overall trail rating
    buildRating('#overall-rating', ratingDescriptors, getWidthVal('#overall-rating'));
    // set rating for difficulty trail rating
    buildRating('#difficulty-rating', ratingDescriptors, getWidthVal('#difficulty-rating'));
    // set rating for views trail rating
    buildRating('#views-rating', ratingDescriptors, getWidthVal('#views-rating'));
    // set rating for popularity trail rating
    buildRating('#popularity-rating', ratingDescriptors, getWidthVal('#popularity-rating'));
});