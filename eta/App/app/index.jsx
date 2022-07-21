import React from 'react';
import ReactDOM from 'react-dom';
import Button from '@material-ui/core/Button';
import CssBaseline from '@material-ui/core/CssBaseline';
import TopBar from './include/TopBar.jsx';
import SideBar from './include/SideBar.jsx';
import { MuiThemeProvider, createMuiTheme } from '@material-ui/core/styles';
import $ from 'jquery';

const theme = createMuiTheme();

function App() {
  return (
    <MuiThemeProvider theme={theme}>
    <React.Fragment>
      <CssBaseline />
      <TopBar />
      <SideBar />
    </React.Fragment>
    </MuiThemeProvider>
  );
}

const app = document.createElement('div');
document.body.appendChild(app);
ReactDOM.render(<App />, app);
