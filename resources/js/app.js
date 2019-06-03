require('./bootstrap');
import React from 'react';
import { render } from 'react-dom';

import App from './components/App';

function init() {
  render(<App />, document.getElementById('app'));
  $('.alert').fadeOut(5000);
}

$(document).ready(init);
