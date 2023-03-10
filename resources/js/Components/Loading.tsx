const Loading = (props) => {
    return (
        <>
            {props.loading ? (
                <div className="fixed top-0 left-0 right-0 w-hull h-full flex items-center justify-center bg-black bg-opacity-70">
                    <div className="flex justify-center">
                        <div className="animate-spin h-10 w-10 border-4 border-blue-500 rounded-full border-t-transparent"></div>
                    </div>
                </div>
            ) : (
                <></>
            )}
        </>
    );
};
export default Loading;
