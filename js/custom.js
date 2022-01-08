function classNameTo(from, to) {
    $('#element1').changeClass(from, to);
}

function getDataSet(element) {
    const data = $('#datasetElement').data();
    $('#datasetResult').innerText(JSON.stringify(data, undefined, 2));
}

function appendSpan() {
    $('#h3append').appendTo('span', '<span>Appended</span>');
}

function prependSpan() {
    $('#h3append').prependTo('span', '<span>Prepended</span>');
}

function getGithubUsername() {
    _$.ajax('https://api.github.com/users/bikramtuladhar', 'GET',
        function (data) {
            $('#username').innerText('username =' + JSON.parse(data).login);
        });
}

function postRequest() {
    event.preventDefault()
    _$.ajax('https://61d9acf6ce86530017e3cbec.mockapi.io/api/users', 'POST',
        function (data) {
            console.log(data);
        }, new FormData(event.target))
}

function promisePostRequest() {
    postNames()
}

function copyClipBoard() {
    $('#clipboard').copyToClipboard()
    alert('Copied to clipboard')
}
