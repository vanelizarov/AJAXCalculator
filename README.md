# AJAXCalculator

Tiny web application for university's task. It takes math expression, that can contain +, -, *, /, %, ^ operations, and then with each change sends AJAX request to server, that calculates result based on sent expression.

## Installation 

```
git clone https://github.com/vanelizarov/AJAXCalculator.git [dir]
cd [dir]
npm install
```

## Usage

1. Run PHP server from `public` directory, f.e.:

```
php -S http://127.0.0.1:8000
```
Then, open provided link in browser

2. Run gulp watch task to track changes in SCSS and JS files

```
npm run watch
```

3. Or run gulp bundle task to create production bundle

```
npm run bundle
```

