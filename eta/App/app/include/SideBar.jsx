import React from 'react';
import PropTypes from 'prop-types';
import { withStyles } from '@material-ui/core/styles';
import Button from '@material-ui/core/Button';
import AddIcon from '@material-ui/icons/Add';
import Icon from '@material-ui/core/Icon';
import DeleteIcon from '@material-ui/icons/Delete';
import NavigationIcon from '@material-ui/icons/Navigation';

const styles = theme => ({
  Bar: {
    position: 'fixed',
    bottom: '20px',
    right: '20px',
  },
  button: {
    margin: theme.spacing.unit,
  },
  extendedIcon: {
    marginRight: theme.spacing.unit,
  },
});

function SideBar(props) {
  const { classes } = props;
  return (
    <div className={classes.Bar}>
      <Button variant="extendedFab" aria-label="Delete" className={classes.button}>
        <NavigationIcon className={classes.extendedIcon} />
        Extended
      </Button>
    </div>
  );
}

SideBar.propTypes = {
  classes: PropTypes.object.isRequired,
};

export default withStyles(styles)(SideBar);
