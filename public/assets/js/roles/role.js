function loadTask(url, keyword) {
    
    return $.ajax({
        method: 'GET',
        dataType: 'json',
        url: url,
        data: { keyword: keyword },
    });
}

export default loadTask;