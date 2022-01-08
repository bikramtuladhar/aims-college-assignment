const postNames = async () => {
    try {
        const res = await Promise.all([
            fetch('https://61d9acf6ce86530017e3cbec.mockapi.io/api/users', {
                method: 'POST', headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({user: 'user 1'}),
            }),
            fetch('https://61d9acf6ce86530017e3cbec.mockapi.io/api/users', {
                method: 'POST', headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({user: 'user 2'}),
            }),
            fetch('https://61d9acf6ce86530017e3cbec.mockapi.io/api/users', {
                method: 'POST', headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({user: 'user 3'}),
            })
        ]);
        const data = res.map((res) => res);
        console.log(data);
    } catch {
        throw Error("Promise failed");
    }
};


