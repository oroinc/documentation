import template from 'text-loader!./App.html';

const App = {
    props: {
        initialTitle: {
            type: String,
            required: true
        },
        initialContent: {
            type: String,
            required: true
        }
    },

    template,

    data() {
        return {
            title: this.initialTitle,
            content: this.initialContent,
            editMode: false
        }
    },

    methods: {
        enterEditMode() {
            this.editMode = true;
        },

        exitEditMode() {
            this.editMode = false;
        }
    }
}

export default App;
