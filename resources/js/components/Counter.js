import React, { Component } from 'react';

export default class SearchBar extends Component {
  constructor() {
    super();
    this.state = { count: 0 }
  }

  onInputChange(term) {
    this.setState({term});
    this.props.onTermChange(term);
  }

  increaseValue() {
    this.setState({count: this.state.count + 1});
  }

  decreaseValue(){
    this.setState({count: this.state.count - 1});
    if (this.state.count==-1) {
      this.setState({count:0});
    }
  }

  render() {
    return (
      <div>
      <button onClick={this.increaseValue.bind(this)}>+</button>
      <button>{this.state.count}</button>
      <button onClick={this.decreaseValue.bind(this)}>-</button>
      </div>
    );
  }
}
