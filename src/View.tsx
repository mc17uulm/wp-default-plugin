import "@babel/polyfill";
import React from "react";
import ReactDOM from "react-dom";
import {Container} from "semantic-ui-react";
import {ToastContainer} from "react-toastify";
import 'semantic-ui-css/semantic.min.css';
import 'react-toastify/dist/ReactToastify.css';
import {Request} from "./api/Request";

export interface Definitions {
    root : string,
    nonce : string,
    slug : string,
    version : string,
    base : string,
    site : string
}

declare var wp_default_plugin_definitions : Definitions;

export class View {

    static run (title : string, element : React.ReactNode) : void {

        Request.initialize(
            wp_default_plugin_definitions.root,
            wp_default_plugin_definitions.nonce,
            wp_default_plugin_definitions.slug,
            wp_default_plugin_definitions.version
        );

        const elem = document.getElementById("wp_default_plugin");
        elem ? ReactDOM.render(
            <Container style={{width: "90%"}}>
                <h1>WP Default Plugin</h1>
                <h3>{title}</h3>
                {element}
                <ToastContainer position="bottom-center" autoClose={2000} />
            </Container>,
            elem
        ) : false;

    }

}