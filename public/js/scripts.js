const padNumber = (number) => {
    if (number < 10) {
        return `0${number}`;
    }
    return `${number}`;
}

const updateDOM = (response) => {
    if(response) {
        const {time, animals} = response.zoo;
        $('#zoo-time').text(`${padNumber(time)}:00`);

        Object.keys(animals).forEach(key => {
            animals[key].forEach((animal, id) => {
                $(`#health-${key}-${id}`).text(Math.round(animal.health * 100));
                $(`#state-${key}-${id}`).text(animal.state);
            })
        })
    }

    const buttons = $(':button');

    buttons.removeClass('btn-disabled');
    buttons.prop('disabled', false);
}

const handleError = (error) => {
    const buttons = $(':button');

    buttons.removeClass('btn-disabled');
    buttons.prop('disabled', false);

    console.log('Error: ', error)
}

$("#add-time").click((event) => {
    event.preventDefault();
    const buttons = $(':button');

    buttons.addClass('btn-disabled');
    buttons.prop('disabled', true);

    $.ajax({
        url: "/api/zoo/add-time",
        type:"PUT",
        success: (response) => updateDOM(response),
        error: (error) => handleError(error)
    });
});

$("#feed-animals").click((event) => {
    event.preventDefault();
    const buttons = $(':button');

    buttons.addClass('btn-disabled');
    buttons.prop('disabled', true);

    $.ajax({
        url: "/api/zoo/animals/feed",
        type:"PUT",
        success: (response) => updateDOM(response),
        error: (error) => handleError(error)
    });
});

$("#zoo-delete").click((event) => {
    event.preventDefault();
    const buttons = $(':button');

    buttons.addClass('btn-disabled');
    buttons.prop('disabled', true);

    $.ajax({
        url: "/api/zoo",
        type:"DELETE",
        success: (response) => updateDOM(response),
        error: (error) => handleError(error)
    });
});
