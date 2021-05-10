import axios from '../../../../src/axios';

const form = document.querySelector('.js-subscribe-form');

if (form) {
  const input = form.querySelector('.js-subscribe-input');
  const messageElement = form.querySelector('.js-subscribe-message');

  if (input && messageElement) {
    form.addEventListener('submit', async (e) => {
      e.preventDefault();

      messageElement.innerHTML = '';
  
      const [res, error, message] = await sendEmail(input.value);

      messageElement.innerHTML = message;
    });
  }
}

const sendEmail = async (email) => {

  try {
    const response = await axios
      .post(`/w-subscribe/subscribe`, {
        email
      });

    const res = response;
    const message = res.data.message ?? 'Success';

    return [res, null, message];
    
  } catch (errors) {
    const res = errors.response;
    const message = res.data.message ?? 'Some error';
    
    return [res, errors, message];
  }
}