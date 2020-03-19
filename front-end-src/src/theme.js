import theme from 'muse-ui/lib/theme';
import 'muse-ui/dist/muse-ui.css';
import './styles/material-icons.css';

theme.add('teal', {
  primary: '#2196f3',
  secondary: '#ff4081',
  success: '#4caf50',
  warning: '#fdd835',
  info: '#2196f3',
  error: '#f44336',
  track: '#bdbdbd',
  divider: 'rgba(0, 0, 0, 0.7)',
  text: {
    primary: 'rgba(0, 0, 0, 0.87)',
    secondary: 'rgba(0, 0, 0, 0.54)',
    alternate: '#fff',
    disabled: 'rgba(0, 0, 0, 0.38)',
    hint: 'rgba(0, 0, 0, 0.38)', // 提示文字颜色
  },
  background: {
    paper: '#fff',
    chip: '#e0e0e0',
    default: '#fff',
  },
}).use('teal');
