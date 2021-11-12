import React, { Component } from 'react';
import PropTypes from 'prop-types';

class App extends Component {
    constructor(props) {
        super(props);
        this.state = {
            title: props.initialTitle,
            content: props.initialContent,
            editMode: false
        };

        this.enterEditMode = this.enterEditMode.bind(this);
        this.exitEditMode = this.exitEditMode.bind(this);
        this.handleChangeTitle = this.handleChangeTitle.bind(this);
        this.handleChangeContent = this.handleChangeContent.bind(this);
    }

    enterEditMode(event) {
        event.preventDefault();

        this.setState({
            editMode: true
        });
    }

    exitEditMode(event) {
        event.preventDefault();

        this.setState({
            editMode: false
        });
    }

    handleChangeTitle(event) {
        this.setState({title: event.target.value});
    }

    handleChangeContent(event) {
        this.setState({content: event.target.value});
    }

    render() {
        const {title, content, editMode} = this.state;
        let children;

        if (editMode) {
            children = <form className="grid">
                <div className="grid__row">
                    <label htmlFor="name">Title</label>
                    <input type="text" id="name" className="input" name="title" onChange={this.handleChangeTitle} defaultValue={title}/>
                </div>
                <div className="grid__row">
                    <label htmlFor="content">Content</label>
                    <textarea className="input" id="content" name="content" onChange={this.handleChangeContent} defaultValue={content}></textarea>
                </div>
                <div className="grid__row">
                    <button type="submit" className="btn btn-primary" onClick={this.exitEditMode}>Update</button>
                </div>
            </form>;
        } else {
            children = <>
                <h1>{title}</h1>
                <p>{content}</p>
                <button className="btn edit-mode" onClick={this.enterEditMode}>Edit</button>
            </>;
        }
        return (
            <>
                {children}
            </>
        );
    }
}

App.propTypes = {
    initialTitle: PropTypes.string.isRequired,
    initialContent: PropTypes.string.isRequired
}

export default App;
