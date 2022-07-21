import React from 'react';
import PropTypes from 'prop-types';
import { withStyles } from '@material-ui/core/styles';
import AppBar from '@material-ui/core/AppBar';
import Toolbar from '@material-ui/core/Toolbar';
import Typography from '@material-ui/core/Typography';
import Button from '@material-ui/core/Button';
import IconButton from '@material-ui/core/IconButton';
import NotificationIcon from '@material-ui/icons/notificationsactive';
import AccountIcon from '@material-ui/icons/accountcircle'
import Tooltip from '@material-ui/core/Tooltip'

const styles = {
  root: {
    flexGrow: 1,
  },
  flex: {
    flexGrow: 1,
  },
};

function TopBar(props) {
  const { classes } = props;
  return (
    <div className={classes.root}>
      <AppBar position="static">
        <Toolbar>
          <Typography variant="title" color="inherit" className={classes.flex}>
            Eta Community
          </Typography>
          <Tooltip title="Notifications">
            <IconButton className={classes.notificationButton} color="inherit" aria-label="Notification">
              <NotificationIcon />
            </IconButton>
          </Tooltip>
          <Tooltip title="Me">
            <IconButton className={classes.AccountBotton} color="inherit" aria-label="Account">
              <AccountIcon />
            </IconButton>
          </Tooltip>
          <Button color="inherit">Login</Button>
        </Toolbar>
      </AppBar>
    </div>
  );
}

TopBar.propTypes = {
  classes: PropTypes.object.isRequired,
};


export default withStyles(styles, { withTheme: true })(TopBar);
