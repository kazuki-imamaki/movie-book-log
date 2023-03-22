import axios from "axios";
const Switch = (props) => {
    const getWant = async () => {
        await axios.get("/api/want").then((res) => {
            props.setContents(res.data);
        });
        props.setDoneFlag(false);
    };

    const getDone = async () => {
        await axios.get("/api/done").then((res) => {
            props.setContents(res.data);
        });
        props.setDoneFlag(true);
    };
    return (
        <>
            <div className="container flex justify-center flex-wrap items-center mx-auto">
                <div
                    className="items-center justify-between hidden w-full md:flex md:w-auto md:order-1"
                    id="navbar-sticky"
                >
                    <div>
                        <button onClick={getWant}>Want to</button>
                    </div>
                    <div>
                        <button onClick={getDone}>Done</button>
                    </div>
                </div>
            </div>
        </>
    );
};
export default Switch;
