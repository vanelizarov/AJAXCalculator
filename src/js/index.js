const inputField = document.querySelector('.input-field');
const resultContainer = document.querySelector('.result');

const calculate = (expr) => {
    return new Promise((resolve, reject) => {
        const req = new XMLHttpRequest();
        const unspacedExpr = expr.split(' ').join('');
        const url = `/api/calc.php?expr=${window.encodeURIComponent(unspacedExpr)}`;

        req.open('GET', url);
        req.onload = () => {
            // req.status === 200 ? resolve(req.responseText) : reject(Error(req.statusText));
            if (req.status === 200) {
                if (req.responseText === 'Error parsing expression') {
                    reject(Error(req.responseText));
                } else {
                    resolve(req.responseText);
                }
            } else {
                reject(Error(req.statusText));
            }
        };
        req.onerror = (e) => reject(Error(`Network error: ${e}`));
        req.send();

    });
};

const setResult = (value = 'No result', error = false) => {
    resultContainer.innerText = value;
    error ? resultContainer.classList.add('result-error') : resultContainer.classList.remove('result-error');
};

inputField.onkeyup = () => {

    if (inputField.value === '') {
        setResult();
    } else {
        calculate(inputField.value)
            .then((result) => {
                setResult(result);
            })
            .catch((error) => {
                setResult(error, true);
            });
    }

};
