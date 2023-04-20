import { Network } from '@capacitor/network';
import { HttpError } from '@/errors/http';

const baseUrl = 'http://127.0.0.1:8010/api/';

export const isOnline = async () => (await Network.getStatus()).connected;

export const httpGet = async (url: string) => {
    return fetch(baseUrl + url)
        .then((response) => {
            if(!response.ok) {
                throw new HttpError(response.status, response.statusText);
            }
            return response.json();
        }).catch((error) => {
            throw new HttpError(0, error.message);
        });
}