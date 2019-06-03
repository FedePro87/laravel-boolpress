require('./bootstrap');
import React from 'react';
import { render } from 'react-dom';

import App from './components/App';

function init() {
  // render(<App />, document.getElementById('app'));
}

$(document).ready(init);
