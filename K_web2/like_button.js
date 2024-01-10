'use strict';

const e = React.createElement;

class LikeButton extends React.Component {
    constructor(props) {
        super(props);
        this.state = { liked: false };
    }

    render() {
        const buttonStyle = {
            fontSize: '16px',
            padding: '10px 20px',
            color: this.state.liked ? '#fff' : '#000',
            backgroundColor: this.state.liked ? '#28a745' : '#007bff',
            border: 'none',
            borderRadius: '5px',
            cursor: 'pointer',
            outline: 'none',
            transition: 'background-color 0.3s'
        };

        const buttonText = this.state.liked ? 'You liked this' : 'Like';

        return e(
            'button',
            {
                onClick: () => this.setState({ liked: !this.state.liked }),
                style: buttonStyle
            },
            this.state.liked ? e('i', { className: 'fas fa-thumbs-up' }) : '',
            buttonText
        );
    }
}

const domContainer = document.querySelector('#like_button_container');
const root = ReactDOM.createRoot(domContainer);
root.render(e(LikeButton));
