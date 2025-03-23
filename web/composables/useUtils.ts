import moment from 'moment';
export function useUtils() {
    

    function momentTimezone(date: any) {
        return moment(date).calendar()
    }

    return {
        momentTimezone
    }
}