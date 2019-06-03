import React, { Component } from 'react';
import SearchBar from '../components/SearchBar';

export default class App extends Component {
  handleTermChange(term) {
    $("#myText").text(term);
  }
  render() {
    return (
      <div>
        <SearchBar onTermChange={this.handleTermChange} />
        <h1 id="myText"></h1>
      </div>
    );
  }
}
