import React from "react";
import $ from 'jquery';

export var connectToStores = Component => class extends React.Component {

    constructor(props) {
        super(props);
        this.subs = [];
        this.props = props;
        this.state = Component.getState();
    }

    componentDidMount() {
        for (let store of Component.getStores()) {
            this.subs.push(store.addListener(this.__onStoreChange.bind(this)));
        }
    }

    componentWillUnmount() {
        this.subs.forEach(s => s.remove());
    }

    __onStoreChange() {
        this.setState(Component.getState());
    }

    render() {
        let componentFactory = React.createFactory(Component);
        return componentFactory($.extend(this.state, this.props));
    }
};

export default connectToStores;
